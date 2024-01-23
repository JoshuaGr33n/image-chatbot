<?php

namespace App\Services;

use App\Models\Conversation;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
// use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class ChatGPTService
{
    protected $apiUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->apiUrl = config('services.chatgpt.api_url');
        $this->apiKey = config('services.chatgpt.api_key');
    }

    public function generateResponse($image, $inputText)
    {

        $client = new Client();

        try {

            $messages = [
                ["role" => "system", "content" => 'you are a helpful assistant. Your name is John. Provide context about the image or any additional information.'],
                ['role' => 'user', 'content' => $inputText],
            ];

            if ($image !== null) {
                $messages[] = ['role' => 'system', 'content' => $image];
            }
            $response = $client->post($this->apiUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => 'gpt-3.5-turbo-16k-0613',
                    'messages' => $messages,
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            // Log the entire exception for detailed debugging
            Log::error('ChatGPT API error:', ['exception' => $e]);

            // Get more information from the exception, if available
            $response = $e->getResponse();
            $statusCode = $response ? $response->getStatusCode() : 'unknown';
            $reasonPhrase = $response ? $response->getReasonPhrase() : 'unknown';

            return [
                'error' => "ChatGPT API error: {$statusCode} - {$reasonPhrase}",
            ];
        } catch (\Exception $e) {
            // Log other exceptions
            Log::error('ChatGPT API error:', ['exception' => $e]);

            return [
                'error' => 'ChatGPT API error: ' . $e->getMessage(),
            ];
        }
    }

    private function imageName($image){
       return time() . '.' . $image->getClientOriginalExtension();
    }

    public function processImage($image)
    {
        if ($image) {
            $imageName = $this->imageName($image);
            $resizedImage = Image::make($image)->resize(300, 200)->save(storage_path('app/public/' . $imageName));
            return base64_encode($resizedImage->encode('jpg')->getEncoded());
        }

        return null;
    }

    public function saveConversation($userId, $userInput, $encodedImage, $response, $image)
    {
        $conversation = new Conversation();
        $conversation->user_id = $userId;
        $conversation->loggedin_user_id = $userId;
        $conversation->message = $userInput;
        $conversation->image_path = $encodedImage ? $this->imageName($image) : null; // Set image_path based on whether an image is present
        $conversation->save();

        $chatGPTMessage = new Conversation();
        $chatGPTMessage->user_id = 1;
        $chatGPTMessage->loggedin_user_id = $userId;
        $chatGPTMessage->message = $response['choices'][0]['message']['content'] ?? 'ChatGPT response missing';
        $chatGPTMessage->image_path = null;
        $chatGPTMessage->save();
    }

    public function showConversation($userId)
    {
        return Conversation::where('loggedin_user_id', $userId)->orderBy('created_at', 'desc')->get();
    }

    public function clearChat($userId)
    {
        // Delete images related to the deleted rows
        $deletedImages = Conversation::where('loggedin_user_id', $userId)->pluck('image_path')->toArray();

        // Delete each image from storage
        foreach ($deletedImages as $imagePath) {
            if ($imagePath) {
                Storage::delete('public/' . $imagePath);
            }
        }

        // Clear messages only for the logged-in user
        Conversation::where('loggedin_user_id', $userId)->delete();
    }
}

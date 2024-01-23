<?php

namespace App\Http\Controllers;

use App\Services\ChatGPTService;
use App\Http\Requests\UserInputRequest;
use Illuminate\Support\Facades\Log;


class ChatGPTController extends Controller
{
    protected $chatGPTService;

    public function __construct(ChatGPTService $chatGPTService)
    {
        $this->chatGPTService = $chatGPTService;
    }

    public function showConversation()
    {
        // Get the logged-in user's ID
        $userId = auth()->id();

        // Call the service method to get conversation messages
        $messages = $this->chatGPTService->showConversation($userId);

        return view('conversation', compact('messages'));
    }

    public function submitUserInput(UserInputRequest $request)
    {
        try {
            $encodedImage = $this->chatGPTService->processImage($request->file('image'));

            // Process user input and send it to ChatGPT
            $userInput = $request->input('user_input');
            $response = $this->chatGPTService->generateResponse($encodedImage, $userInput);
            Log::info('ChatGPT Response:', $response);

            // Save user input and chatbot response to conversation history (database or other storage)
            $this->chatGPTService->saveConversation(auth()->id(), $userInput, $encodedImage, $response, $request->file('image'));

            // Redirect back to conversation view
            return redirect()->route('show.conversation');
        } catch (\Exception $e) {
            // Log the error
            Log::error('ChatGPT API error:', ['exception' => $e]);

            // Handle the error gracefully and provide feedback to the user
            return back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }

    public function clearChat()
    {
        // Get the logged-in user's ID
        $userId = auth()->id();

        // Call the service method to clear chat
        $this->chatGPTService->clearChat($userId);

        // Redirect back to the conversation view
        return redirect()->route('show.conversation');
    }
}

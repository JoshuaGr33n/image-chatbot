<?php

namespace App\Services;

use App\Models\Feedback;

class FeedbackService
{
    public function createFeedback(array $feedbackData)
    {
        $feedbackData['user_id'] = auth()->id();
        Feedback::create($feedbackData);
    }

    public function getUserFeedback($userId)
    {
        return Feedback::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
    }
}

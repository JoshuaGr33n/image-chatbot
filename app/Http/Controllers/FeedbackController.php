<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FeedbackRequest;
use App\Services\FeedbackService;
class FeedbackController extends Controller
{

    protected $feedbackService;

    public function __construct(FeedbackService $feedbackService)
    {
        $this->feedbackService = $feedbackService;
    }

    public function index()
    {
        $feedbacks = $this->feedbackService->getUserFeedback(auth()->id());

        return view('feedback.index', compact('feedbacks'));
    }

    public function create()
    {
        return view('feedback.create');
    }

    public function store(FeedbackRequest $request)
    {
        $this->feedbackService->createFeedback($request->all());
        return redirect()->route('feedback.create')->with('success', 'Feedback submitted successfully!');
    }
}

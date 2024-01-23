@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Feedback</h1>

    <div class="form-group">
        <a href="{{ route('feedback.create') }}">Back</a>
    </div>

    <div class="form-group">
        <a href="{{ route('show.conversation') }}">Chat</a>
    </div>

    @foreach($feedbacks as $feedback)
    <div class="feedback-item">
        <p>User: {{ $feedback->user->name }}</p>
        <p>Feedback Type: {{ $feedback->feedback_type }}</p>
        <p>Comment: {{ $feedback->comment ?? 'No comment' }}</p>
        <p>Submitted: {{ $feedback->created_at->diffForHumans() }}</p>
    </div>
    @endforeach

    @if($feedbacks->isEmpty())
    <p>No feedback available.</p>
    @endif
</div>

<style>
    .feedback-item {
        border: 1px solid #ddd;
        padding: 10px;
        margin-bottom: 10px;
    }
</style>
@endsection

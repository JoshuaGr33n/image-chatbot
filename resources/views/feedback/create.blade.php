@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Provide Feedback</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <div class="form-group">
        <a href="{{ route('feedback.index') }}">See your feedbacks</a>
    </div>

    <div class="form-group">
        <a href="{{ route('show.conversation') }}">Back</a>
    </div>

    <form method="post" action="{{ route('feedback.store') }}">
        @csrf

        <div class="form-group">
            <label for="feedback_type">Feedback Type:</label>
            <select name="feedback_type" id="feedback_type" class="form-control" required>
                <option value="positive">Positive</option>
                <option value="neutral">Neutral</option>
                <option value="negative">Negative</option>
            </select>
        </div>

        <div class="form-group">
            <label for="comment">Comment (optional):</label>
            <textarea name="comment" id="comment" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit Feedback</button>
    </form>
</div>
@endsection
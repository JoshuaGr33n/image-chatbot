@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Conversation with Chatbot</h1>
    <!-- Display Error Message -->
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Error!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    <!-- User Input Form -->
    <form method="post" action="{{ route('submit.user.input') }}" enctype="multipart/form-data">
        @csrf
        <!-- Display Validation Error for 'user_input' -->
        @error('user_input')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <!-- Display Validation Error for 'image' -->
        @error('image')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <input type="file" name="image" accept="image/*">
        <input type="text" name="user_input" placeholder="Type your message...">
        <button type="submit">Send</button>
    </form>

    <!-- Clear Chat Button and Feedback Link -->
    @if($messages->isNotEmpty())
        <div class="form-group">
            <form method="post" action="{{ route('clearChat') }}">
                @csrf
                <button type="submit" onclick="return confirm('Are you sure you want to clear the chat?')">Clear Chat</button>
            </form>
        </div>
        <div class="form-group">
            <a href="{{ route('feedback.create') }}">Provide Feedback on your experience</a>
        </div>
    @endif
    <!-- Conversation Thread -->
    <div class="conversation-thread">
        @foreach($messages as $message)
        <div class="message">
            <div class="message-header">
                <strong>{{ $message->user->name }}</strong>
                <span class="time-ago">{{ $message->created_at->diffForHumans() }}</span>
            </div>
            <div class="message-content">
                {{ $message->message }}
                @if ($message->image_path)
                <br>
                <img src="{{ asset('storage/' . $message->image_path) }}" alt="Uploaded Image">
                @endif
            </div>
        </div>
        @endforeach
    </div>


</div>
@endsection

<style>
    .conversation-thread {
        margin-top: 20px;
    }

    .message {
        border: 1px solid #ddd;
        padding: 10px;
        margin-bottom: 10px;
    }

    .message-header {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .time-ago {
        color: #777;
        font-size: 12px;
        margin-left: 10px;
    }

    .message-content img {
        max-width: 100%;
        margin-top: 10px;
    }

    form {
        margin-top: 20px;
    }

    .form-group {
        margin-bottom: 10px;
    }
</style>
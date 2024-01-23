<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;

class UserHistoryController extends Controller
{
    public function index()
    {
        // Retrieve conversation history for the authenticated user
        $user = auth()->user();
        $conversations = $user->conversations;

        return view('user_history.index', compact('conversations'));
    }
}
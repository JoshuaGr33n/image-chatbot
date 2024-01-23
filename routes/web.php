<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatGPTController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\UserHistoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');





Route::middleware(['auth', 'auth.user'])->group(function () {
    Route::get('/conversation', [ChatGPTController::class, 'showConversation'])->name('show.conversation');
    Route::post('/conversation', [ChatGPTController::class, 'submitUserInput'])->name('submit.user.input');
    Route::post('/clear-chat', [ChatGPTController::class, 'clearChat'])->name('clearChat');

    Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
    Route::get('/feedback/create', [FeedbackController::class, 'create'])->name('feedback.create');
    Route::post('/feedback/store', [FeedbackController::class, 'store'])->name('feedback.store');
   
    Route::get('/user/history', [UserHistoryController::class, 'index'])->name('user.history');
});

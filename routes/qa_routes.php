<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;

Route::middleware(['auth'])->group(function () {

    Route::post('/questions', [QuestionController::class, 'store'])
        ->name('questions.store');

    Route::post('/answers', [AnswerController::class, 'store'])
        ->name('answers.store');

});

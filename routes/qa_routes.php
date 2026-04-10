<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\SkillQuestionController;
use App\Http\Controllers\SkillAnswerController;

Route::middleware(['auth'])->group(function () {

    Route::post('/questions', [QuestionController::class, 'store'])
        ->name('questions.store');

    Route::post('/answers', [AnswerController::class, 'store'])
        ->name('answers.store');

});

Route::middleware(['auth'])->group(function () {
    Route::get('/live-skill-qa/sessions/{session}/token', [\App\Http\Controllers\LiveSkillQaCallController::class, 'token'])
        ->name('live-skill-qa.token');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/skill-qa', [SkillQuestionController::class, 'index'])->name('skill-qa.index');
    Route::get('/skill-qa/create', [SkillQuestionController::class, 'create'])->name('skill-qa.create');
    Route::post('/skill-qa', [SkillQuestionController::class, 'store'])->name('skill-qa.store');
    Route::get('/skill-qa/{skillQuestion}', [SkillQuestionController::class, 'show'])->name('skill-qa.show');
    Route::post('/skill-qa/{skillQuestion}/answer', [SkillAnswerController::class, 'store'])->name('skill-qa.answer.store');
});

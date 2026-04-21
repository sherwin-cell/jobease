<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('skill_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skill_question_id');
            $table->unsignedBigInteger('user_id');
            $table->text('answer');
            $table->timestamps();

            $table->foreign('skill_question_id')->references('id')->on('skill_questions')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skill_answers');
    }
};

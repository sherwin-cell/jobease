<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('job_live_skill_qa_session_participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained('job_live_skill_qa_sessions')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('role', 20); // employer|job_seeker

            $table->timestamp('joined_at')->nullable();
            $table->timestamp('left_at')->nullable();

            $table->unsignedTinyInteger('rating')->nullable(); // 1-5
            $table->text('feedback')->nullable();

            $table->timestamps();

            $table->unique(['session_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_live_skill_qa_session_participants');
    }
};


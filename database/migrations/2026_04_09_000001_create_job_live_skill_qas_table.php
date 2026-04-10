<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('job_live_skill_qas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained('jobs')->cascadeOnDelete();

            $table->boolean('enabled')->default(false);
            $table->unsignedSmallInteger('duration_minutes')->nullable(); // 15 or 30
            $table->unsignedSmallInteger('max_candidates')->nullable(); // e.g. 10
            $table->string('session_type')->nullable(); // video_audio | audio_only | screen_share
            $table->boolean('screen_sharing_allowed')->default(false);

            // Array of { start_at: ISO8601, end_at: ISO8601 }
            $table->json('slots')->nullable();

            // Optional: categories list + specific questions list
            $table->json('question_categories')->nullable(); // e.g. ["Laravel", "SQL"]
            $table->json('questions')->nullable(); // e.g. [{ "category": "SQL", "question": "..." }]

            $table->timestamps();

            $table->unique('job_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_live_skill_qas');
    }
};


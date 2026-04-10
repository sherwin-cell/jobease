<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('job_live_skill_qa_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained('jobs')->cascadeOnDelete();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete(); // employer

            $table->dateTime('slot_start_at');
            $table->dateTime('slot_end_at');

            $table->string('agora_channel', 128);
            $table->string('status', 20)->default('scheduled'); // scheduled|live|ended|cancelled

            $table->timestamp('started_at')->nullable();
            $table->timestamp('ended_at')->nullable();

            $table->timestamps();

            $table->index(['job_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_live_skill_qa_sessions');
    }
};


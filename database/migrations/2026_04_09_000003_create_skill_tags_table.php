<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('skill_tags', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });
        Schema::create('skill_question_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('skill_question_id')->constrained('skill_questions')->onDelete('cascade');
            $table->foreignId('skill_tag_id')->constrained('skill_tags')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skill_question_tag');
        Schema::dropIfExists('skill_tags');
    }
};

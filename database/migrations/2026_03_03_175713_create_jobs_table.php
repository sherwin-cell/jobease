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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('location')->nullable();
            $table->string('skills_required')->nullable(); // comma-separated
            $table->string('experience_level')->nullable(); // e.g., Junior, Mid, Senior
            $table->decimal('salary', 12, 2)->nullable();
            $table->foreignId('employer_id')->constrained('users')->onDelete('cascade'); // job posted by employer
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};

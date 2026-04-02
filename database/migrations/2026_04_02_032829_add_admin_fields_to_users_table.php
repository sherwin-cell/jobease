<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'employer', 'jobseeker'])->default('jobseeker');
            $table->boolean('is_approved')->default(true); // auto approve on registration
            $table->boolean('is_verified')->default(false); // optional for future verification
            $table->boolean('is_banned')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'is_approved', 'is_verified', 'is_banned']);
        });
    }
};
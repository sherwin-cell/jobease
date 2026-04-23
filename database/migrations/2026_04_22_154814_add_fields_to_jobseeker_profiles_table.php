<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('jobseeker_profiles', function (Blueprint $table) {
            $table->json('skills')->nullable()->after('user_id');
            $table->json('experience')->nullable();
            $table->json('education')->nullable();
            $table->json('certifications')->nullable();
            $table->json('interests')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('jobseeker_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'skills',
                'experience',
                'education',
                'certifications',
                'interests'
            ]);
        });
    }
};

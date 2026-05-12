<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('jobseeker_profiles', function (Blueprint $table) {
            // Check and add each column only if it doesn't exist
            if (!Schema::hasColumn('jobseeker_profiles', 'skills')) {
                $table->json('skills')->nullable()->after('user_id');
            }
            
            if (!Schema::hasColumn('jobseeker_profiles', 'experience')) {
                $table->json('experience')->nullable();
            }
            
            if (!Schema::hasColumn('jobseeker_profiles', 'education')) {
                $table->json('education')->nullable();
            }
            
            if (!Schema::hasColumn('jobseeker_profiles', 'certifications')) {
                $table->json('certifications')->nullable();
            }
            
            if (!Schema::hasColumn('jobseeker_profiles', 'interests')) {
                $table->json('interests')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('jobseeker_profiles', function (Blueprint $table) {
            $columns = ['skills', 'experience', 'education', 'certifications', 'interests'];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('jobseeker_profiles', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
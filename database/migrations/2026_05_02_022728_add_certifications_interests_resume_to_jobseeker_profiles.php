<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\JobseekerProfile;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add columns if they don't exist
        Schema::table('jobseeker_profiles', function (Blueprint $table) {
            if (!Schema::hasColumn('jobseeker_profiles', 'certifications')) {
                $table->json('certifications')->nullable()->after('interests');
            }
            
            if (!Schema::hasColumn('jobseeker_profiles', 'interests')) {
                $table->json('interests')->nullable()->after('certifications');
            }
            
            if (!Schema::hasColumn('jobseeker_profiles', 'resume_path')) {
                $table->string('resume_path')->nullable()->after('website');
            }
        });
        
        // Update existing profile (id = 1) with sample data
        $profile = JobseekerProfile::find(1);
        if ($profile) {
            if (is_null($profile->certifications)) {
                $profile->certifications = [
                    'AWS Certified Developer',
                    'Laravel Certified',
                    'JavaScript ES6 Certified'
                ];
            }
            
            if (is_null($profile->interests)) {
                $profile->interests = [
                    'Open Source Contribution',
                    'AI & Machine Learning',
                    'Cloud Architecture'
                ];
            }
            
            $profile->save();
        }
        
        // Update any other profiles with NULL values to empty arrays
        JobseekerProfile::whereNull('certifications')->update(['certifications' => []]);
        JobseekerProfile::whereNull('interests')->update(['interests' => []]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobseeker_profiles', function (Blueprint $table) {
            if (Schema::hasColumn('jobseeker_profiles', 'certifications')) {
                $table->dropColumn('certifications');
            }
            
            if (Schema::hasColumn('jobseeker_profiles', 'interests')) {
                $table->dropColumn('interests');
            }
            
            if (Schema::hasColumn('jobseeker_profiles', 'resume_path')) {
                $table->dropColumn('resume_path');
            }
        });
    }
};
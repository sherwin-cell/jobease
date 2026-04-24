<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('jobseeker_profiles', function (Blueprint $table) {

            if (!Schema::hasColumn('jobseeker_profiles', 'headline')) {
                $table->string('headline')->nullable()->after('user_id');
            }

            if (!Schema::hasColumn('jobseeker_profiles', 'bio')) {
                $table->text('bio')->nullable()->after('headline');
            }

            if (!Schema::hasColumn('jobseeker_profiles', 'location')) {
                $table->string('location')->nullable();
            }

            if (!Schema::hasColumn('jobseeker_profiles', 'phone')) {
                $table->string('phone')->nullable();
            }

            if (!Schema::hasColumn('jobseeker_profiles', 'website')) {
                $table->string('website')->nullable();
            }

        });
    }

    public function down(): void
    {
        Schema::table('jobseeker_profiles', function (Blueprint $table) {
            $table->dropColumn(['headline', 'bio', 'location', 'phone', 'website']);
        });
    }
};
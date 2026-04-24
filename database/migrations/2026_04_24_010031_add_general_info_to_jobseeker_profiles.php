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
        Schema::table('jobseeker_profiles', function (Blueprint $table) {

            if (!Schema::hasColumn('jobseeker_profiles', 'headline')) {
                $table->string('headline')->nullable();
            }

            if (!Schema::hasColumn('jobseeker_profiles', 'bio')) {
                $table->text('bio')->nullable();
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobseeker_profiles', function (Blueprint $table) {
            //
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    public function up(): void
    {
        Schema::table('jobseeker_profiles', function (Blueprint $table) {
            
            // Add column if it doesn't exist
            if (!Schema::hasColumn('jobseeker_profiles', 'user_id')) {
                $table->foreignId('user_id')->after('id')->nullable();
            }
            
        });
        
        // Check and add foreign key constraint outside of Schema::table
        try {
            $foreignKeyExists = false;
            
            // Get existing foreign keys using raw SQL
            $constraints = DB::select("
                SELECT CONSTRAINT_NAME 
                FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
                WHERE TABLE_SCHEMA = DATABASE() 
                AND TABLE_NAME = 'jobseeker_profiles' 
                AND CONSTRAINT_NAME = 'jobseeker_profiles_user_id_foreign'
            ");
            
            if (empty($constraints)) {
                // Add foreign key constraint using raw SQL
                DB::statement("
                    ALTER TABLE `jobseeker_profiles` 
                    ADD CONSTRAINT `jobseeker_profiles_user_id_foreign` 
                    FOREIGN KEY (`user_id`) 
                    REFERENCES `users` (`id`) 
                    ON DELETE CASCADE
                ");
            }
        } catch (\Exception $e) {
            // Foreign key might already exist or table doesn't exist yet
        }
    }

    public function down(): void
    {
        Schema::table('jobseeker_profiles', function (Blueprint $table) {
            // Drop foreign key if exists
            try {
                DB::statement("ALTER TABLE `jobseeker_profiles` DROP FOREIGN KEY `jobseeker_profiles_user_id_foreign`");
            } catch (\Exception $e) {
                // Foreign key doesn't exist
            }
            
            // Drop column if exists
            if (Schema::hasColumn('jobseeker_profiles', 'user_id')) {
                $table->dropColumn('user_id');
            }
        });
    }
};
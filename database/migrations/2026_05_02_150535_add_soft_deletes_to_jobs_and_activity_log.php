<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Add soft deletes to users table (most important)
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'deleted_at')) {
                $table->softDeletes();
            }
        });
        
        // Add soft deletes to jobs table
        Schema::table('jobs', function (Blueprint $table) {
            if (!Schema::hasColumn('jobs', 'deleted_at')) {
                $table->softDeletes();
            }
        });
        
        // Check if activity_log table exists before adding soft deletes
        if (Schema::hasTable('activity_log')) {
            Schema::table('activity_log', function (Blueprint $table) {
                if (!Schema::hasColumn('activity_log', 'deleted_at')) {
                    $table->softDeletes();
                }
            });
        }
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        
        // Check if activity_log table exists before dropping soft deletes
        if (Schema::hasTable('activity_log')) {
            Schema::table('activity_log', function (Blueprint $table) {
                $table->dropSoftDeletes();
            });
        }
    }
};
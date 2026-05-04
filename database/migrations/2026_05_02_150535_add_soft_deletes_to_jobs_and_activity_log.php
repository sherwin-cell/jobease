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
        
        // Add soft deletes to activity_log table (Spatie's table - singular)
        Schema::table('activity_log', function (Blueprint $table) {
            if (!Schema::hasColumn('activity_log', 'deleted_at')) {
                $table->softDeletes();
            }
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        
        Schema::table('activity_log', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
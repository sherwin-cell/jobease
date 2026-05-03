<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Add soft deletes to jobs table
        Schema::table('jobs', function (Blueprint $table) {
            if (!Schema::hasColumn('jobs', 'deleted_at')) {
                $table->softDeletes();
            }
        });
        
        // Add soft deletes to activity_logs table
        Schema::table('activity_logs', function (Blueprint $table) {
            if (!Schema::hasColumn('activity_logs', 'deleted_at')) {
                $table->softDeletes();
            }
        });
    }
    
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        
        Schema::table('activity_logs', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
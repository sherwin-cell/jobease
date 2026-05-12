<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Check if activity_log table exists
        if (Schema::hasTable('activity_log')) {
            Schema::table('activity_log', function (Blueprint $table) {
                if (!Schema::hasColumn('activity_log', 'job_id')) {
                    $table->foreignId('job_id')
                          ->nullable()
                          ->after('id')
                          ->constrained('jobs')
                          ->onDelete('cascade');
                }
            });
        }
    }
    
    public function down()
    {
        if (Schema::hasTable('activity_log')) {
            Schema::table('activity_log', function (Blueprint $table) {
                try {
                    $table->dropForeign(['job_id']);
                    $table->dropColumn('job_id');
                } catch (\Exception $e) {
                    // Foreign key or column might not exist
                }
            });
        }
    }
};
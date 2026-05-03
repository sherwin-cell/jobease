<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // Check if column exists first
        if (Schema::hasTable('jobs') && !Schema::hasColumn('jobs', 'status')) {
            Schema::table('jobs', function (Blueprint $table) {
                $table->string('status')->default('pending');
            });
        } else {
            Schema::table('jobs', function (Blueprint $table) {
                $table->string('status')->default('pending')->change();
            });
        }
    }

    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->string('status')->default(null)->change();
        });
    }
};
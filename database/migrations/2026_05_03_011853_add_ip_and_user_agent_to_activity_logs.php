<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            if (!Schema::hasColumn('activity_logs', 'ip_address')) {
                $table->string('ip_address')->nullable()->after('description');
            }
            if (!Schema::hasColumn('activity_logs', 'user_agent')) {
                $table->text('user_agent')->nullable()->after('ip_address');
            }
        });
    }

    public function down()
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            $table->dropColumn(['ip_address', 'user_agent']);
        });
    }
};
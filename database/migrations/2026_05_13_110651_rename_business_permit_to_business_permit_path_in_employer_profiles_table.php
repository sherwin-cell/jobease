<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('employer_profiles', function (Blueprint $table) {
            // Rename the column
            $table->renameColumn('business_permit', 'business_permit_path');
        });
    }

    public function down()
    {
        Schema::table('employer_profiles', function (Blueprint $table) {
            $table->renameColumn('business_permit_path', 'business_permit');
        });
    }
};
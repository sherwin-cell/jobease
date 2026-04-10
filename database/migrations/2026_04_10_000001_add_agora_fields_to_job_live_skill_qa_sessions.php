<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('job_live_skill_qa_sessions', function (Blueprint $table) {
            $table->string('agora_channel_name')->nullable();
            $table->string('agora_token', 512)->nullable();
        });
    }

    public function down()
    {
        Schema::table('job_live_skill_qa_sessions', function (Blueprint $table) {
            $table->dropColumn(['agora_channel_name', 'agora_token']);
        });
    }
};

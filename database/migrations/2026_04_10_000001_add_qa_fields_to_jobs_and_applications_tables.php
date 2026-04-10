<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->json('qa_questions')->nullable()->after('skills_required');
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->json('qa_answers')->nullable()->after('resume');
        });
    }

    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn('qa_questions');
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn('qa_answers');
        });
    }
};

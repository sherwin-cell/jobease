<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('employer_profiles', function (Blueprint $table) {

            if (!Schema::hasColumn('employer_profiles', 'approval_status')) {
                $table->string('approval_status')->default('pending');
            }

            if (!Schema::hasColumn('employer_profiles', 'approved_at')) {
                $table->timestamp('approved_at')->nullable();
            }

            if (!Schema::hasColumn('employer_profiles', 'approved_by')) {
                $table->foreignId('approved_by')
                    ->nullable()
                    ->constrained('users')
                    ->nullOnDelete();
            }

            if (!Schema::hasColumn('employer_profiles', 'rejection_reason')) {
                $table->text('rejection_reason')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('employer_profiles', function (Blueprint $table) {

            $table->dropColumn([
                'approval_status',
                'approved_at',
                'approved_by',
                'rejection_reason'
            ]);

        });
    }
};
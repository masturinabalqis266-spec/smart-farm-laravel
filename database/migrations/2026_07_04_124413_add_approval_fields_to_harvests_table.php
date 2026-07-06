<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('harvests', function (Blueprint $table) {
            $table->date('harvest_date')->nullable()->after('crop_block_id');
            $table->time('harvest_time')->nullable()->after('harvest_date');

            $table->string('approval_status')->default('Pending')->after('notes');
            $table->foreignId('approved_by')
                  ->nullable()
                  ->after('approval_status')
                  ->constrained('users')
                  ->nullOnDelete();

            $table->timestamp('approved_at')->nullable()->after('approved_by');
        });
    }

    public function down(): void
    {
        Schema::table('harvests', function (Blueprint $table) {
            $table->dropForeign(['approved_by']);

            $table->dropColumn([
                'harvest_date',
                'harvest_time',
                'approval_status',
                'approved_by',
                'approved_at',
            ]);
        });
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('crop_blocks', function (Blueprint $table) {
        $table->id();
        $table->string('block_name');
        $table->string('crop_variety');
        $table->integer('tree_count');
        $table->date('planting_date');
        $table->enum('growth_status', [
            'Seedling',
            'Maturing',
            'Yielding',
            'Harvested',
            'Inactive'
        ])->default('Seedling');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crop_blocks');
    }
};

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
        Schema::create('creatures', function (Blueprint $table) {
            $table->id();
            $table->string('name');         // creatureの名前
            // 各進化段階の画像URL or パス
            $table->longText('image_stage_1');
            $table->longText('image_stage_2');
            $table->longText('image_stage_3');
            $table->longText('image_stage_4');
            $table->longText('image_stage_5');
            $table->longText('image_stage_6');

            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creatures');
    }
};

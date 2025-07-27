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
        Schema::create('user_creatures', function (Blueprint $table) {
            $table->id(); // 必須：個別の育成を一意に識別
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('creature_id')->nullable()->constrained()->onDelete('set null');
            $table->unsignedTinyInteger('stage')->default(1);
            $table->boolean('current')->default(true);
            $table->timestamps(); // 推奨：育成開始・更新の記録
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_creatures');
    }
};

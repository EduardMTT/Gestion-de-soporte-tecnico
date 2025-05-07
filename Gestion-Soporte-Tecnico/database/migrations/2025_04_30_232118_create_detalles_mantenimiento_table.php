<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detalles_mantenimiento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mantenimiento_id')
                  ->constrained('mantenimientos')
                  ->cascadeOnDelete();
            $table->foreignId('pieza_id')
                  ->constrained('piezas')
                  ->cascadeOnDelete();
            $table->integer('cantidad')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalles_mantenimiento');
    }
};

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
        Schema::create('ejercicio', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('postId');
            $table->string('nombre');
            $table->string('descripcionUnidades');
            $table->string('intensidad');
            $table->integer('serie');
            $table->integer('unidades');
            $table->timestamps();
            $table->foreign('postId')->references('id')->on('post')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ejercicio');
    }
};

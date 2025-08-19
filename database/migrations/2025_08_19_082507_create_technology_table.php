<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('technologies', function (Blueprint $table) {
            $table->id();
            $table->string('product');
            $table->longText('desc')->nullable();
            $table->decimal('net', 15, 2)->nullable(); // Net Present Value
            $table->string('profit')->nullable(); // "55% Profit" style or numeric
            $table->string('image')->nullable();
            $table->string('poster')->nullable();
            $table->json('inventors')->nullable(); // store as array
            $table->string('ip_status')->nullable();
            $table->json('proposition')->nullable(); // array of items
            $table->json('benefits')->nullable();    // array of items
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technology');
    }
};

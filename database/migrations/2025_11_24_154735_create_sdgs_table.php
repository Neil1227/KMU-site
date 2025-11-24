<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sdgs', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('sdg_number')->unique(); // SDG number 1-17
            $table->text('description')->nullable(); // Main content
            $table->string('gallery_link')->nullable(); // Gallery URL
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sdgs');
    }
};

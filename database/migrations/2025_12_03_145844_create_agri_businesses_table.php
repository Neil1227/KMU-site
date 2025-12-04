<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agri_businesses', function (Blueprint $table) {
            $table->id();
            $table->string('thesis_title')->nullable();
            $table->text('technologies')->nullable();
            $table->string('technology_generator')->nullable();
            $table->string('type_of_technology')->nullable();
            $table->string('contact_info')->nullable();
            $table->text('remarks')->nullable();
            $table->string('link')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agri_businesses');
    }
};

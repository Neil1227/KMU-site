<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('technology_licensing_units', function (Blueprint $table) {
            $table->id();
            $table->string('thesis_title')->nullable();
            $table->string('technologies')->nullable();
            $table->string('technology_generator')->nullable();
            $table->string('type_of_technology')->nullable();
            $table->string('contact_info')->nullable();
            $table->string('remarks')->nullable();
            $table->string('link')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technology_licensing_units');
    }
};

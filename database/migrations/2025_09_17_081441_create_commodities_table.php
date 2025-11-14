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
        Schema::create('commodities', function (Blueprint $table) {
            $table->id();
            $table->string('commodity')->nullable();
            $table->string('thesis_title')->nullable();
            $table->string('technologies')->nullable();
            $table->string('technology_generator')->nullable();
            $table->string('contact_info')->nullable();
            $table->string('type_of_technology')->nullable();
            $table->string('ip_status')->nullable();
            $table->string('trl_level')->nullable();
            $table->string('sdgs')->nullable();
            $table->text('remarks')->nullable();
            $table->text('recommendations')->nullable();
            $table->string('link')->nullable();
            $table->string('priority_area')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commodities');
    }
};

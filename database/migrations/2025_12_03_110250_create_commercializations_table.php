<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('commercializations', function (Blueprint $table) {
            $table->id();

            // Foreign key from commodity table
            $table->unsignedBigInteger('commodity_id');
            $table->foreign('commodity_id')
                ->references('id')
                ->on('commodities')
                ->onDelete('cascade');

            $table->string('thesis_title')->nullable();
            $table->text('technologies')->nullable();
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

    public function down()
    {
        Schema::dropIfExists('commercializations');
    }
};

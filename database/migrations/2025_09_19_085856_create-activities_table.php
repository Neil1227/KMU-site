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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('action'); // created, updated, deleted
            $table->string('model');  // e.g. Commodity
            $table->unsignedBigInteger('record_id')->nullable(); // id of affected record

            // Commodity-specific fields you want to track
            $table->string('thesis_title')->nullable();
            $table->string('technology')->nullable();
            $table->string('ip_status')->nullable();

            $table->text('changes')->nullable(); // optional JSON
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};

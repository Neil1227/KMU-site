<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sdg_media', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sdg_id'); // references SDG
            $table->string('title');
            $table->string('image'); // path to stored image
            $table->string('sdg_targets')->nullable(); // e.g., "1.2, 1.3"
            $table->timestamps();

            $table->foreign('sdg_id')->references('id')->on('sdgs')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sdg_media');
    }
};

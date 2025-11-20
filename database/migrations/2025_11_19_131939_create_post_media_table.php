<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('post_media', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->enum('type', ['image', 'video', 'file', 'link']);
            $table->string('url'); // store the path to media
            $table->timestamps();

            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('post_media');
    }
};

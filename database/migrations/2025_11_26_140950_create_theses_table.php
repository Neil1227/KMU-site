<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('theses', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('fullname');
            $table->string('psau_id')->unique();
            $table->string('contact_number');
            $table->boolean('graduate_student')->default(false);
            $table->string('googledrive_link')->nullable();

            // PDF extracted metadata
            $table->string('college')->nullable();
            $table->string('program')->nullable();
            $table->string('thesis_title')->nullable();
            $table->string('adviser')->nullable();
            $table->text('groupmates')->nullable();
            $table->year('graduation_year')->nullable();

            $table->string('file_path'); // Path to uploaded PDF
            $table->timestamps();
        });
    }


    
    public function down(): void
    {
        Schema::dropIfExists('theses');
    }
};

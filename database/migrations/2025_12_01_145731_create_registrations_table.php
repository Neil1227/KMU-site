<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->nullable();
            $table->string('title')->nullable();
            $table->string('remarks')->nullable();
            $table->date('date_received')->nullable();
            $table->string('inventor_owner')->nullable();
            $table->string('ip_type')->nullable();
            $table->text('comment')->nullable();
            $table->string('notice')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('registrations');
    }
}

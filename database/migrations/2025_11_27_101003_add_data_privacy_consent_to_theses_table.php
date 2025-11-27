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
    Schema::table('theses', function (Blueprint $table) {
        $table->boolean('data_privacy_consent')->default(false)->after('googledrive_link');
    });
}

public function down(): void
{
    Schema::table('theses', function (Blueprint $table) {
        $table->dropColumn('data_privacy_consent');
    });
}

};

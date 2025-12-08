<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('commercializations', function (Blueprint $table) {
            $table->boolean('pushed_to_promotion')->default(false)->after('remarks');
            $table->boolean('pushed_to_agri')->default(false)->after('pushed_to_promotion');
        });
    }

    public function down(): void
    {
        Schema::table('commercializations', function (Blueprint $table) {
            $table->dropColumn(['pushed_to_promotion', 'pushed_to_agri']);
        });
    }
};

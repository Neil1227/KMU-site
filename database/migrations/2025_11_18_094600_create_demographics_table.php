<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // If table does NOT exist, create it
        if (!Schema::hasTable('demographics')) {
            Schema::create('demographics', function (Blueprint $table) {
                $table->id();
                $table->string('region')->nullable();
                $table->string('sex')->nullable();
                $table->string('status')->nullable();
                $table->timestamps();
            });
            return;
        }

        // If table exists, modify it
        Schema::table('demographics', function (Blueprint $table) {
            if (!Schema::hasColumn('demographics', 'region')) {
                $table->string('region')->nullable();
            }
            if (!Schema::hasColumn('demographics', 'sex')) {
                $table->string('sex')->nullable();
            }
            if (!Schema::hasColumn('demographics', 'status')) {
                $table->string('status')->nullable();
            }
        });
    }

    public function down(): void
    {
        // Drop only the added columns if table exists
        if (Schema::hasTable('demographics')) {
            Schema::table('demographics', function (Blueprint $table) {
                if (Schema::hasColumn('demographics', 'region')) {
                    $table->dropColumn('region');
                }
                if (Schema::hasColumn('demographics', 'sex')) {
                    $table->dropColumn('sex');
                }
                if (Schema::hasColumn('demographics', 'status')) {
                    $table->dropColumn('status');
                }
            });
        }
    }
};

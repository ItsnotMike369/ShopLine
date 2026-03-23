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
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable()->after('name');
            $table->string('last_name')->nullable()->after('first_name');
            $table->tinyInteger('birth_month')->nullable()->after('last_name');
            $table->tinyInteger('birth_day')->nullable()->after('birth_month');
            $table->smallInteger('birth_year')->nullable()->after('birth_day');
            $table->string('gender')->nullable()->after('birth_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['first_name', 'last_name', 'birth_month', 'birth_day', 'birth_year', 'gender']);
        });
    }
};

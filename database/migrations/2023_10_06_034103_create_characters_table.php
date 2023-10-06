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
        Schema::create('characters', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('character_link');
            $table->string('protected_character_link');
            $table->string('name');
            $table->integer('level');
            $table->integer('realm_id');
            $table->tinyInteger('playable_class_id');
            $table->tinyInteger('playable_race_id');
            $table->tinyInteger('gender_id');
            $table->tinyInteger('faction_id');
            $table->foreignId('account_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};

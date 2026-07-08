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
        Schema::create('user_shinies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            
            $table->string('pokemon_name');
            $table->string('nature')->nullable();
            
            $table->integer('hp_iv')->nullable();
            $table->integer('attack_iv')->nullable();
            $table->integer('defense_iv')->nullable();
            $table->integer('sp_attack_iv')->nullable();
            $table->integer('sp_defense_iv')->nullable();
            $table->integer('speed_iv')->nullable();

            $table->integer('encounters')->nullable();
            $table->date('catch_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_shinies');
    }
};

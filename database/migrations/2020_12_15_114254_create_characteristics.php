<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharacteristics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characteristics', function (Blueprint $table)
        {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('game_id');
            $table->text('description');
            $table->timestamps();

            $table->foreign('game_id')->on('games')->references('id')->onDelete('cascade');
            $table->unique(['name', 'game_id']);
        });

        Schema::create('heroes_characteristics', function (Blueprint $table)
        {
            $table->id();
            $table->unsignedBigInteger('hero_id');
            $table->unsignedBigInteger('characteristic_id');
            $table->integer('value')->nullable();
            $table->unique(['hero_id', 'characteristic_id']);

            $table->foreign('hero_id')->on('heroes')->references('id')->onDelete('cascade');
            $table->foreign('characteristic_id')->on('characteristics')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('heroes_characteristics');
        Schema::dropIfExists('characteristics');
    }
}

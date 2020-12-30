<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserHeroes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_heroes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('game_id');
            $table->unsignedBigInteger('user_id');
            $table->text('note')->nullable();
            $table->timestamps();

            $table->foreign('game_id')->on('games')->references('id')->onDelete('cascade');
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_heroes');
    }
}

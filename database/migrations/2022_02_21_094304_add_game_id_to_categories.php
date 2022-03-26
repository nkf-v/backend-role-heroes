<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGameIdToCategories extends Migration
{
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) : void
        {
            $table->unsignedBigInteger('game_id')->nullable();

            $table->foreign('game_id')->on('games')->references('id')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('categories', function (Blueprint $table) : void
        {
            $table->dropForeign(['game_id']);
            $table->dropColumn(['game_id']);
        });
    }
}

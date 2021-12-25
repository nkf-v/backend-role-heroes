<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) : void
        {
            $table->id();
            $table->unsignedBigInteger('game_id');
            $table->unsignedSmallInteger('type');
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            $table->foreign('game_id')->on('games')->references('id')->onDelete('cascade');
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
        });

        Schema::create('item_fields', function (Blueprint $table) : void
        {
            $table->id();
            $table->unsignedBigInteger('game_id');
            $table->unsignedSmallInteger('item_type');
            $table->string('name');
            $table->unsignedSmallInteger('value_type');
            $table->timestamps();

            $table->foreign('game_id')->on('games')->references('id')->onDelete('cascade');
        });

        Schema::create('item_field_values', function (Blueprint $table) : void
        {
            $table->id();
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('field_id');
            $table->integer('value_int')->nullable();
            $table->string('value_string')->nullable();
            $table->boolean('value_bool')->nullable();
            $table->double('value_double')->nullable();
            $table->timestamps();

            $table->foreign('item_id')->on('items')->references('id')->onDelete('cascade');
            $table->foreign('field_id')->on('item_fields')->references('id')->onDelete('cascade');
        });

        Schema::create('heroes_items', function (Blueprint $table) : void
        {
            $table->id();
            $table->unsignedBigInteger('hero_id');
            $table->unsignedBigInteger('item_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('heroes_items');
        Schema::dropIfExists('item_field_values');
        Schema::dropIfExists('item_fields');
        Schema::dropIfExists('items');
    }
}

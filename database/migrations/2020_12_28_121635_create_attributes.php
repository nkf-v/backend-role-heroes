<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_categories', function (Blueprint $table) : void
        {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('attributes', function (Blueprint $table) : void
        {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('type_value');
            $table->unsignedBigInteger('game_id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->on('attribute_categories')->references('id')->onDelete('set null');
            $table->foreign('game_id')->on('games')->references('id')->onDelete('cascade');
        });

        Schema::create('heroes_attribute_values', function (Blueprint $table) : void
        {
            $table->id();
            $table->unsignedBigInteger('attribute_id');
            $table->unsignedBigInteger('hero_id');
            $table->integer('value_int')->nullable();
            $table->string('value_string')->nullable();
            $table->boolean('value_bool')->nullable();
            $table->double('value_double')->nullable();

            $table->unique(['attribute_id', 'hero_id']);

            $table->foreign('attribute_id')->on('attributes')->references('id')->onDelete('cascade');
            $table->foreign('hero_id')->on('heroes')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('heroes_attribute_values');
        Schema::dropIfExists('attributes');
        Schema::dropIfExists('attribute_categories');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStructuralAttributes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('structural_attributes', function (Blueprint $table) : void
        {
            $table->id();
            $table->boolean('multiply');
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('game_id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->timestamps();

            $table->foreign('game_id')->on('games')->references('id')->onDelete('cascade');
            $table->foreign('category_id')->on('categories')->references('id')->onDelete('set null');
        });

        Schema::create('structure_fields', function (Blueprint $table) : void
        {
            $table->id();
            $table->unsignedBigInteger('attribute_id');
            $table->string('name');
            $table->unsignedInteger('type');
            $table->timestamps();

            $table->unique(['attribute_id', 'name', 'type']);

            $table->foreign('attribute_id')->on('structural_attributes')->references('id')->onDelete('cascade');
        });

        Schema::create('structural_attribute_values', function (Blueprint $table) : void
        {
            $table->id();
            $table->unsignedBigInteger('attribute_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('attribute_id')->on('structural_attributes')->references('id')->onDelete('cascade');
        });

        Schema::create('structural_field_values', function (Blueprint $table) : void
        {
            $table->id();
            $table->unsignedBigInteger('attribute_value_id');
            $table->unsignedBigInteger('attribute_field_id');
            $table->integer('value_int')->nullable();
            $table->string('value_string')->nullable();
            $table->boolean('value_bool')->nullable();
            $table->double('value_double')->nullable();
            $table->timestamps();

            $table->unique(['attribute_value_id', 'attribute_field_id']);

            $table->foreign('attribute_value_id')->on('structural_attribute_values')->references('id')->onDelete('cascade');
            $table->foreign('attribute_field_id')->on('structure_fields')->references('id')->onDelete('cascade');
        });

        Schema::create('hero_structural_attribute_values', function (Blueprint $table) : void
        {
            $table->id();
            $table->unsignedBigInteger('hero_id');
            $table->unsignedBigInteger('attribute_value_id');
            $table->timestamps();

            $table->unique(['hero_id', 'attribute_value_id']);

            $table->foreign('hero_id')->on('heroes')->references('id')->onDelete('cascade');
            $table->foreign('attribute_value_id')->on('structural_field_values')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('hero_structural_attribute_values');
       Schema::dropIfExists('structural_field_values');
       Schema::dropIfExists('structural_attribute_values');
       Schema::dropIfExists('structure_fields');
       Schema::dropIfExists('structural_attributes');
    }
}

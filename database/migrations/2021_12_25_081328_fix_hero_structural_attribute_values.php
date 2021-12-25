<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixHeroStructuralAttributeValues extends Migration
{
    public function up()
    {
        Schema::table('hero_structural_attribute_values', function (Blueprint $table) : void
        {
            $table->dropForeign(['attribute_value_id']);
            $table->foreign('attribute_value_id')->on('structural_attribute_values')->references('id')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('hero_structural_attribute_values', function (Blueprint $table) : void
        {
            $table->dropForeign(['attribute_value_id']);
            $table->foreign('attribute_value_id')->on('structural_field_values')->references('id')->onDelete('cascade');
        });
    }
}

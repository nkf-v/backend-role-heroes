<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValueSelectToStructuralAttributeFieldValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('structure_field_select_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('field_id');
            $table->string('label', 100);
            $table->timestamps();

            $table->foreign('field_id')
                ->on('structure_fields')
                ->references('id')
                ->onDelete('cascade');
        });

        Schema::table('structural_field_values', function (Blueprint $table) {
            $table->unsignedBigInteger('value_select')
                ->nullable()
                ->after('value_double');

            $table->foreign('value_select')
                ->on('structure_field_select_options')
                ->references('id')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('structural_field_values', function (Blueprint $table) {
            $table->dropForeign(['value_select']);
            $table->dropColumn(['value_select']);
        });

        Schema::dropIfExists('structure_field_select_options');
    }
}

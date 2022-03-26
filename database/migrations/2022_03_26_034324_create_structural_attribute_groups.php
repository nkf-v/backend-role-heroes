<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStructuralAttributeGroups extends Migration
{
    public function up(): void
    {
        Schema::create('structural_attribute_value_groups', function (Blueprint $table): void
        {
            $table->id();
            $table->string('name', 25);
            $table->unsignedBigInteger('attribute_id');
            $table->timestamps();

            $table->foreign('attribute_id')
                ->on('structural_attributes')
                ->references('id')
                ->onDelete('cascade');
        });

        Schema::table('structural_attribute_values', function (Blueprint $table): void
        {
            $table->unsignedBigInteger('group_id')->nullable();

            $table->foreign('group_id')
                ->on('structural_attribute_value_groups')
                ->references('id')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('structural_attribute_values', function (Blueprint $table): void
        {
            $table->dropForeign(['group_id']);
            $table->dropColumn(['group_id']);
        });

        Schema::dropIfExists('structural_attribute_value_groups');
    }
}

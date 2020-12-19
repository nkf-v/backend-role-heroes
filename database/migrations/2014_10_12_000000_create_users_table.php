<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table)
        {
            $table->id();
            $table->string('login')->unique();
            $table->string('password');
            $table->timestamps();
        });

        Schema::create('user_tokens', function (Blueprint $table)
        {
            $table->id();
            $table->text('token')->unique();
            $table->unsignedBigInteger('user_id');

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
        Schema::dropIfExists('user_tokens');
        Schema::dropIfExists('users');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account', function (Blueprint $table) {
            $table->increments('UID')->comment('Unique ID');
            $table->string('Username')->comment('Account Username');
            $table->string('Email')->unique()->comment('Email Address');
            $table->string('Password')->comment('Hashed Password');
            $table->integer('AdminLevel')->comment('Admin Level');
            $table->rememberToken()->comment('Auto Login Token');
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
        Schema::dropIfExists('users');
    }
}

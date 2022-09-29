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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable(true);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('firstname')->nullable(true);
            $table->string('lastname')->nullable(true);
            $table->string('phoneNumber')->nullable(true);
            $table->string('address')->nullable(true);
            $table->string('postalCode')->nullable(true);
            $table->string('city')->nullable(true);
            $table->string('country')->nullable(true);
            $table->string('appartement')->nullable(true);
            $table->string('customerComment')->nullable(true);
            $table->string('depositComment')->nullable(true);
            $table->rememberToken();
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

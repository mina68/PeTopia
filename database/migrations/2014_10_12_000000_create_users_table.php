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
            $table->integer('type'); // 0 is admin, 1 is normal user
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username')->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->string('mobile')->nullable();
            $table->string('password');
            $table->string('image')->nullable();
            $table->enum('gender',['male', 'female', 'other'])->nullable();
            $table->string('birthdate')->nullable();

            $table->boolean('first_login')->default(true);
            $table->boolean('verified')->default(true);
            $table->boolean('active')->default(true);

            $table->string('nationality')->nullable();
            $table->string('country')->nullable();
            $table->string('governorate')->nullable();
            $table->string('city')->nullable();
            $table->string('area')->nullable();
            $table->string('district')->nullable(); 
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

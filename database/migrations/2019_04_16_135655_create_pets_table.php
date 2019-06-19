<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pet_type_id')->unsigned();
            $table->string('response_name');
            $table->date('birthday');
            $table->string('birth_country');
            $table->string('color');
            $table->enum('sex',['male', 'female']);
            $table->float('weight');
            $table->string('breed');
            $table->boolean('altered');
            $table->integer('price');
            $table->text('notes')->nullable();
            $table->boolean('hidden')->default(0);
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
        Schema::dropIfExists('pets');
    }
}

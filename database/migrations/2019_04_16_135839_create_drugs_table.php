<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drugs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pet_type_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('manufacturer')->nullable();
            $table->integer('concentration_num')->default(0);
            $table->string('active_constituent')->nullable();
            $table->float('price');
            $table->integer('in_stock')->default(0);
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
        Schema::dropIfExists('drugs');
    }
}

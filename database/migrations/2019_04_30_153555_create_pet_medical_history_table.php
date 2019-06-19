<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetMedicalHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pet_medical_history', function (Blueprint $table) {
            $table->integer('medical_vaccination_id')->unsigned();
            $table->integer('pet_id')->unsigned();
            $table->date('good_until');
            $table->timestamps();

            $table->primary(['pet_id', 'medical_vaccination_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pet_medical_history');
    }
}

<?php

use Illuminate\Database\Seeder;

class MedicalVaccinationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\MedicalVaccination::class, 10)->create();
    }
}

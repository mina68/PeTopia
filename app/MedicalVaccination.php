<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Pet;

class MedicalVaccination extends Model
{
    protected $table = "medical_vaccinations";
    protected $guarded = ['id'];
    public $timestamps = true;

    public function pets(){
    	return $this->belongsToMany('App\Pet', 'pet_medical_history', 'medical_vaccination_id', 'pet_id')->withPivot('good_until')->withTimestamps();
    }

    public static function getInSelectForm($with_balnk_option = false, $exceptedIds = [] )
    {
        $medical_vaccinations = [];
        
        $with_balnk_option ? $medical_vaccinations = ['' => 'Select'] : $medical_vaccinations = [];

        $medical_vaccinations_DB = MedicalVaccination::whereNotIn('id',$exceptedIds)->get();
        
        foreach ($medical_vaccinations_DB as $medical_vaccination) {
          $medical_vaccinations[$medical_vaccination->id] = $medical_vaccination->name;
        }

        return $medical_vaccinations;
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\MedicalVaccination;
use App\PetImage;

class Pet extends Model
{
    protected $table = "pets";
    protected $guarded = ['id'];
    public $timestamps = true;

    public function medicalHistory(){
    	return $this->belongsToMany('App\MedicalVaccination', 'pet_medical_history', 'pet_id', 'medical_vaccination_id')->withPivot('good_until');
    }

    public function images(){
    	return $this->hasMany('App\PetImage', 'pet_id');
    }

    public function type(){
    	return $this->belongsTo('App\PetType', 'pet_type_id');
    }
}

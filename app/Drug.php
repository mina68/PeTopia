<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\DrugImage;

class Drug extends Model
{
    protected $table = 'drugs';
    protected $guarded = ['id'];
    public $timestamps = true;

    public function images(){
    	return $this->hasMany('App\DrugImage', 'drug_id');
    }

    public function petType(){
    	return $this->belongsTo('App\PetType', 'pet_type_id');
    }
}

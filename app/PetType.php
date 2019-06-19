<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Pet;

class PetType extends Model
{
    protected $table = 'pet_types';
    protected $guarded = ['id'];
    public $timestamps = true;

    public function pets(){
    	return $this->hasMany('App\Pet', 'pet_type_id');
    }

    public function foods(){
    	return $this->hasMany('App\Food', 'pet_type_id');
    }

    public function drugs(){
    	return $this->hasMany('App\Drug', 'pet_type_id');
    }

    public function supplies(){
    	return $this->hasMany('App\Supply', 'pet_type_id');
    }

    public static function getInSelectForm($with_balnk_option = false, $exceptedIds = [] )
    {
        $pet_types = [];

        $with_balnk_option ? $pet_types = ['' => 'Select'] : $pet_types = [];

        $pet_types_DB = PetType::whereNotIn('id',$exceptedIds)->get();
        
        foreach ($pet_types_DB as $pet_type) {
          $pet_types[$pet_type->id] = $pet_type->name;
        }

        return $pet_types;
    }
}

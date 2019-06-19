<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = "foods";
    protected $guarded = ['id'];
    public $timestamps = true;

    public function sizes(){
    	return $this->hasMany('App\FoodSize', 'food_id');
    }

    public function images(){
    	return $this->hasMany('App\FoodImage', 'food_id');
    }

    public function type(){
    	return $this->belongsTo('App\FoodType', 'food_type_id');
    }

    public function petType(){
        return $this->belongsTo('App\PetType', 'pet_type_id');
    }
}

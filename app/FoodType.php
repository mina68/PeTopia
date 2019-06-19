<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodType extends Model
{
    protected $table = 'food_types';
	protected $guarded = ['id'];
	public $timestamps = true;

    public function foods(){
    	return $this->hasMany('App\Food', 'food_type_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodImage extends Model
{
    protected $table = 'food_images';
	protected $guarded = ['id'];
	public $timestamps = true;

    public function food(){
    	return $this->belongsTo('App\Food', 'food_id');
    }
}

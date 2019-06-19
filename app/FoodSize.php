<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodSize extends Model
{
    protected $table = 'food_sizes';
	protected $guarded = ['id'];
	public $timestamps = true;

    public function food(){
    	return $this->belongsTo('App\Food', 'food_id');
    }
}

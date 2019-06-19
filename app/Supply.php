<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    protected $table = 'supplies';
    protected $guarded = ['id'];
    public $timestamps = true;

    public function petType(){
    	return $this->belongsTo('App\PetType', 'pet_type_id');
    }

    public function images(){
    	return $this->hasMany('App\SupplyImage', 'supply_id');
    }
}

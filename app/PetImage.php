<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Pet;

class PetImage extends Model
{
	protected $table = 'pet_images';
	protected $guarded = ['id'];
	public $timestamps = true;

    public function pet(){
    	return $this->belongsTo('App\Pet', 'pet_id');
    }
}

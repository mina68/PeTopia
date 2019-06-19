<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Drug;

class DrugImage extends Model
{
    protected $table = 'drug_images';
	protected $guarded = ['id'];
	public $timestamps = true;

    public function drug(){
    	return $this->belongsTo('App\Drug', 'drug_id');
    }
}

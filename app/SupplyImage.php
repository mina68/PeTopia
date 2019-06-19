<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Supply;

class SupplyImage extends Model
{
	protected $table = 'supply_images';
	protected $guarded = ['id'];
	public $timestamps = true;

    public function supply(){
    	return $this->belongsTo('App\Supply', 'supply_id');
    }
}

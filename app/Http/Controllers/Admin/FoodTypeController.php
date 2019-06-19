<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use DataTables;
use App\FoodType;
use Illuminate\Http\Request;

class FoodTypeController extends Controller
{
    public function index(){
		$active = ['system_setup', 'food_types'];
		return view('admin.foodTypes.index', compact('active'));
	}

    public function apiIndex()
    {
    	return DataTables::of(FoodType::all())->make(true);
    }
}

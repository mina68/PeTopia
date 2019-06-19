<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use DataTables;
use App\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index(){
		$active = ['products', 'foods'];
		return view('admin.foods.index', compact('active'));
	}

    public function apiIndex()
    {
    	return DataTables::of(Food::with('type', 'petType', 'sizes')->get())->make(true);
    }
}

<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use DataTables;
use App\Drug;
use Illuminate\Http\Request;

class DrugController extends Controller
{
    public function index(){
		$active = ['products', 'drugs'];
		return view('admin.drugs.index', compact('active'));
	}

    public function apiIndex()
    {
    	return DataTables::of(Drug::with('petType')->get())->make(true);
    }
}

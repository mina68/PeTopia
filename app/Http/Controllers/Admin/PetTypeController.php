<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use DataTables;
use App\PetType;
use Illuminate\Http\Request;

class PetTypeController extends Controller
{
    public function index(){
		$active = ['system_setup', 'pet_types'];
		return view('admin.petTypes.index', compact('active'));
	}

    public function apiIndex()
    {
    	return DataTables::of(PetType::all())->make(true);
    }
}

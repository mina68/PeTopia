<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use DataTables;
use App\Supply;
use Illuminate\Http\Request;

class SupplyController extends Controller
{
    public function index(){
		$active = ['products', 'supplies'];
		return view('admin.supplies.index', compact('active'));
	}

    public function apiIndex()
    {
    	return DataTables::of(Supply::with('petType')->get())->make(true);
    }
}

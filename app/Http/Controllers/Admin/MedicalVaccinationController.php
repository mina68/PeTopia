<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use DataTables;
use App\MedicalVaccination;
use Illuminate\Http\Request;

class MedicalVaccinationController extends Controller
{
    public function index(){
		$active = ['system_setup', 'medical_vaccinations'];
		return view('admin.medicalVaccinations.index', compact('active'));
	}

    public function apiIndex()
    {
    	return DataTables::of(MedicalVaccination::all())->make(true);
    }
}

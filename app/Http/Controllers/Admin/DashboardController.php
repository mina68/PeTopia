<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
    	$active = ['dashboard'];
    	return view('admin.dashboard', compact('active'));
    }

    public function refreshCsrfAjax()
    {
        $csrf_token = csrf_token();

        return response()->json([
                    'requestStatus'   => true,
                    'csrfToken'       => $csrf_token
                ]);
    }
}

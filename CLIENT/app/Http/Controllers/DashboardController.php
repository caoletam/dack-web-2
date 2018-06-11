<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;

class DashboardController extends Controller
{
    //
    public function index(){
    	// dd(Session::get('checkAdminLogin'));
    	if(Session::get('checkAdminLogin')==1){
    		dd('Đăng nhập thành công!');
    	}
    	// dd('Chưa đăng nhập!');
    	// return view('admin.dashboard.dashboard');
    	return redirect('admin/login');
    }
}

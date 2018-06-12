<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;

class DashboardController extends Controller
{
    //
    public function index(){
    	// dd(Session::get('checkAdminLogin'));
    	// if(Session::get('checkAdminLogin')==1){
    	// 	dd('Đăng nhập thành công!');
    	// }
    	if(session('checkAdminLogin')){
    		return view('admin.dashboard.dashboard');
    	}
    	// dd('Chưa đăng nhập!');
    	// return view('admin.dashboard.dashboard');
    	return redirect('admin/login');
    }
}

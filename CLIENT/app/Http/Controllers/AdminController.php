<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use Session;

class AdminController extends Controller
{
    //
    public function login(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('admin.login'); 
        }
        if ($request->isMethod('POST')) {
        	// dd($request->all()); 
        	$param_array = array(
				'txtEmail' => $request->input('txtEmail'),
				'txtPassword' => $request->input('txtPassword')
			);
			$param = json_encode($param_array);
        	$url = 'http://localhost:3000/taikhoan/kiemtradangnhap';
        	$ch = curl_init($url);
        	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
			curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        	$result = curl_exec($ch);
        	curl_close($ch);
        	
        	if($result==1){
        		Session::put('checkAdminLogin', '1');
        	}

        	return redirect('admin/dashboard');

        }
    }

    public function logout(){
    	Session::forget('checkAdminLogin');
    	return view('admin.login');
    }

}

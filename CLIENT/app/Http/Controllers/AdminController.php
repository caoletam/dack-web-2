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

        	$url = 'http://localhost:3000/taikhoan/';
        	$ch = curl_init($url);

        	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        	$result = curl_exec($ch);
        	curl_close($ch);

        	$result_decoded = json_decode($result);
        	// dd($result_decoded);

        	foreach ($result_decoded as $rs) {
        		echo '<pre>';
        		echo($rs->matkhau);
        		echo '</pre>';
        		if ((Hash::check($request->txtPassword, $rs->matkhau)) && $rs->email == $request->txtEmail){
				    // The passwords match...
				    Session::put('checkAdminLogin', '1');
				    return redirect('admin/dashboard');
				}
				// else{
				// 	echo 'sai. Người dùng '.$rs->tendangnhap;
				// }
        	}
        	return redirect('admin/dashboard');

        }
    }

    public function logout(){
    	Session::forget('checkAdminLogin');
    	return view('admin.login');
    }

}

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
				'txtEmail' => 'tamle@gmail.com',
				'txtPassword' => '123456789'
			);
			$param = json_encode($param_array);
			// dd($param);
			// $param_decode = json_decode($param);

        	$url = 'http://localhost:3000/taikhoan/kiemtradangnhap';
        	$ch = curl_init($url);

        	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        	// Thiết lập sử dụng POST
			// curl_setopt($ch, CURLOPT_POST, count($param_array));
			curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			 
			// Thiết lập các dữ liệu gửi đi
			curl_setopt($ch, CURLOPT_POSTFIELDS, $param);

        	$result = curl_exec($ch);
        	curl_close($ch);
        	dd($result);
        	// $result_decoded = json_decode($result);
        	// dd($result_decoded);

    //     	foreach ($result_decoded as $rs) {
    //     		echo '<pre>';
    //     		echo($rs->matkhau);
    //     		echo '</pre>';
    //     		if ((Hash::check($request->txtPassword, $rs->matkhau)) && $rs->email == $request->txtEmail){
				//     // The passwords match...
				//     Session::put('checkAdminLogin', '1');
				//     return redirect('admin/dashboard');
				// }
				// // else{
				// // 	echo 'sai. Người dùng '.$rs->tendangnhap;
				// // }
    //     	}
    //     	return redirect('admin/dashboard');

        }
    }

    public function logout(){
    	Session::forget('checkAdminLogin');
    	return view('admin.login');
    }

}

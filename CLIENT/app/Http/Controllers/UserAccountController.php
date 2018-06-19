<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;

class UserAccountController extends Controller
{
    //
    public function login(Request $request){
    	

    	if($request->isMethod('post')){
            $param_array = array(
                'txtEmail' => $request->input('txtEmail'),
                'txtPassword' => $request->input('txtPassword')
            );
            $param = json_encode($param_array);
            $url = $this->host.'/taikhoan/kiemtradangnhap/user';
            $ch = curl_init($url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
            $result = curl_exec($ch);
            curl_close($ch);

            
            
            if($result==1){
                $name = $this->getInfoUserByEmail($request->input('txtEmail'));
                // dd($name);
                Session::put('checkLogin', '1');
                Session::put('name', $name[0]->tenhienthi);
            }
            return redirect()->back()->back();
    	}
    	$getListTypeOfProduct = $this->getListTypeOfProduct();
    	return view('user.user.login')->with('getListTypeOfProduct',$getListTypeOfProduct);
    }

    public function register(Request $request){
    	if($request->isMethod('post')){
            $param_array = array(
                'tendangnhap' => $request->input('txtUserName'),
                'matkhau' => $request->input('txtPassword'),
                'tenhienthi' => $request->input('txtName'),
                'email' => $request->input('txtEmail'),
                'dienthoai' => $request->input('txtPhone'),
                'diachi' => $request->input('txtAddress'),
                'maloaitaikhoan' => 1
            );
            $param = json_encode($param_array);
            $url = $this->host.'/taikhoan/';
            $ch = curl_init($url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
            $result = curl_exec($ch);
            curl_close($ch);

            $name = $this->getInfoUserByEmail($request->input('txtEmail'));
            Session::put('checkLogin', '1');
            Session::put('name', $name[0]->tenhienthi);
            return redirect('/');
    	}

    	$getListTypeOfProduct = $this->getListTypeOfProduct();
    	return view('user.user.register')->with('getListTypeOfProduct',$getListTypeOfProduct);
    }

    public function logout(){
        Session::forget('checkLogin');
        Session::forget('name');
        return redirect()->back();
    }

    public function getListTypeOfProduct(){
	    $url = $this->host.'/loaisanpham/';
	    $ch = curl_init($url);
	    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	    $result = curl_exec($ch);
	    curl_close($ch);
	    $result_decode = (object) json_decode($result);
	    // dd($result_decode);
	    return $result_decode;
	}

    public function getInfoUserByEmail($email){

        $param_array = array(
            'email' => $email
        );
        $param = json_encode($param_array);
        $url = $this->host.'/taikhoan/thongtin';
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        $result = curl_exec($ch);
        curl_close($ch);
        $result_decode = json_decode($result);
        return $result_decode;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function getListUser(){
        $url = $this->host.'/taikhoan/';
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $result = curl_exec($ch);
        curl_close($ch);
        $result_decode = (object) json_decode($result);
        return $result_decode;
    }

    public function getListTypeOfUser(){
        $url = $this->host.'/loaitaikhoan/';
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $result = curl_exec($ch);
        curl_close($ch);
        $result_decode = (object) json_decode($result);
        return $result_decode;
    }

    public function index(){
        if(session('checkAdminLogin')){
            $result_decode_user = $this->getListUser();
            $result_decode_type_of_user = $this->getListTypeOfUser();
            return view('admin.user.index')->with('list_user',$result_decode_user)->with('list_type_of_user',$result_decode_type_of_user);
        }
        return redirect('admin/login');
    }

    public function create(Request $request){
        if($request->isMethod('post')){
            // dd($request->all());
            $param_array = array(
                'tendangnhap' => $request->input('txtUserName'),
                'tenhienthi' => $request->input('txtName'),
                'email' => $request->input('txtEmail'),
                'dienthoai' => $request->input('txtPhone'),
                'diachi' => $request->input('txtAddress'),
                'maloaitaikhoan' => $request->input('cbType'),
                'matkhau' => $request->input('txtPassword')
            );
            $param = json_encode($param_array);
            $url = $this->host.'/taikhoan/';
            $ch = curl_init($url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
            $result = curl_exec($ch);
            curl_close($ch);
            return redirect('admin/user');
        }

        $result_decode_type_of_user = $this->getListTypeOfUser();
        return view('admin.user.user-add')->with('result_decode_type_of_user',$result_decode_type_of_user);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function getListUser(){
        $url = 'http://localhost:3000/taikhoan/';
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $result = curl_exec($ch);
        curl_close($ch);
        // $result_decode = json_decode($result);
        // dd($result_decode_1);
        // $result_array = (array) json_decode($result);
        // $result_deocode = json_decode($result_array);
        $result_decode = (object) json_decode($result);
        return $result_decode;
    }

    public function getListTypeOfUser(){
        $url = 'http://localhost:3000/loaitaikhoan/';
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $result = curl_exec($ch);
        curl_close($ch);
        // $result_decode = json_decode($result);
        // dd($result_decode_1);
        // $result_array = (array) json_decode($result);
        // $result_deocode = json_decode($result_array);
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

        }
        return view('admin.user.user-add');
    }
}

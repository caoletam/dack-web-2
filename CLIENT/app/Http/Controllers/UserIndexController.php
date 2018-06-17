<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserIndexController extends Controller
{
    //
    public function index(){
    	$getListProduct = $this->getListProduct();
    	$getListAuction = $this->getListAuction();
    	$getListTypeOfProduct = $this->getListTypeOfProduct();
    	return view('user.product.index')->with('getListProduct',$getListProduct)->with('getListAuction',$getListAuction)->with('getListTypeOfProduct',$getListTypeOfProduct);
    }

    public function getListProduct(){
    	$url = 'http://localhost:3000/sanpham/';
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $result = curl_exec($ch);
        curl_close($ch);
        $result_decode = (array) json_decode($result);
        // dd($result_decode);
        return $result_decode;
    }

    public function getListAuction(){
    	$url = 'http://localhost:3000/phiendaugia/';
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $result = curl_exec($ch);
        curl_close($ch);
        $result_decode = (object) json_decode($result);
        // dd($result_decode);
        return $result_decode;
    }

    public function getListTypeOfProduct(){
        $url = 'http://localhost:3000/loaisanpham/';
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $result = curl_exec($ch);
        curl_close($ch);
        $result_decode = (object) json_decode($result);
        // dd($result_decode);
        return $result_decode;
    }
}

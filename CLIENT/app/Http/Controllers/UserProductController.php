<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserProductController extends Controller
{
    //
    public function index($id){

    	$getListTypeOfProduct = $this->getListTypeOfProduct();
    	$getListProductByTypeID = $this->getListProductByTypeID($id);
    	$getListAuction = $this->getListAuction();
    	
		return view('user.product.category')->with('getListProductByTypeID',$getListProductByTypeID)->with('getListTypeOfProduct',$getListTypeOfProduct)->with('getListAuction',$getListAuction);
    }

    public function getListProductByTypeID($id){
    	$url = $this->host.'/sanpham/maloaisanpham/'.$id;
		$ch = curl_init($url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		$result = curl_exec($ch);
		curl_close($ch);
		$result_decode = (array) json_decode($result);
		return $result_decode;
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

    public function getListAuction(){
    	$url = $this->host.'/phiendaugia/';
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $result = curl_exec($ch);
        curl_close($ch);
        $result_decode = (object) json_decode($result);
        // dd($result_decode);
        return $result_decode;
    }
}

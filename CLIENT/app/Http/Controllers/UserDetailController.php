<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

class UserDetailController extends Controller
{
    //
    // ID là mã sản phẩm lấy trên link (id routes)
    public function index($id){
    	// $getRealTime = $this->getRealTime($id);
    	$getProductByID = $this->getProductByID($id);
    	$getListTypeOfProduct = $this->getListTypeOfProduct();
    	$getAuctionByIDProduct = $this->getAuctionByIDProduct($id);
    	return view('user.product.detail')->with('getListTypeOfProduct',$getListTypeOfProduct)->with('getProductByID',$getProductByID)->with('getAuctionByIDProduct',$getAuctionByIDProduct);
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

	public function getProductByID($id){
    	$url = 'http://localhost:3000/sanpham/'.$id;
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $result = curl_exec($ch);
        curl_close($ch);
        $result_decode = (object) json_decode($result)[0];
        // dd($result_decode->masanpham);
        return $result_decode;
    }

    public function getAuctionByIDProduct($id){
    	$url = 'http://localhost:3000/phiendaugia/masanpham/'.$id;
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $result = curl_exec($ch);
        curl_close($ch);
        $result_decode = (object) json_decode($result)[0];
        // dd($result_decode->maphiendaugia);
        // dd($result_decode);
        return $result_decode;
    }

    public function getRealTime($id){
    	
    	$url = 'http://localhost:3000/phiendaugia/thoigiandau/masanpham/'.$id;
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $result = curl_exec($ch);
        curl_close($ch);
        $result_decode = json_decode($result);
        return response()->json(['day' => $result_decode->day, 'hour' => $result_decode->hour, 'minute' => $result_decode->minute, 'second' => $result_decode->second]);
    }
}

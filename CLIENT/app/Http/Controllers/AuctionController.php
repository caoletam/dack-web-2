<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

class AuctionController extends Controller
{
    //
    public function index(){
		$listAuction = $this->getListAuction();
		$listProduct = $this->getListProduct();
		$listAuctionStatus = $this->getListAuctionStatus();
		// dd($listProduct);
    	return view('admin.auction.index')->with('listAuction',$listAuction)->with('listProduct',$listProduct)->with('listAuctionStatus',$listAuctionStatus);
    }

    // $id này là id của phiên đấu giá
    public function updateStatus(Request $request,$id){
    	if($request->isMethod('post')){
    		// dd($request->all());
    		$param_array = array(
                'status' => $request->input('txtStatus')
            );
            $param = json_encode($param_array);
            $url = 'http://localhost:3000/phiendaugia/capnhattinhtrang/'.$id;
            $ch = curl_init($url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
            $result = curl_exec($ch);
            curl_close($ch);
            return redirect('admin/auction');
    	}
    	return redirect('admin/auction');
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

    public function getListCoupon(){
    	$url = 'http://localhost:3000/phieudaugia/';
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $result = curl_exec($ch);
        curl_close($ch);
        $result_decode = (object) json_decode($result);
        // dd($result_decode);
        return $result_decode;
    }

    public function getListAuctionStatus(){
    	$url = 'http://localhost:3000/tinhtrangphiendaugia/';
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $result = curl_exec($ch);
        curl_close($ch);
        $result_decode = (object) json_decode($result);
        // dd($result_decode);
        return $result_decode;
    }
}

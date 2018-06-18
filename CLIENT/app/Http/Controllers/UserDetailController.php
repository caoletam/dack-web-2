<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use Session;

class UserDetailController extends Controller
{
    public function index($id){
    	$getProductByID = $this->getProductByID($id);
    	$getListTypeOfProduct = $this->getListTypeOfProduct();
    	$getAuctionByIDProduct = $this->getAuctionByIDProduct($id);
    	return view('user.product.detail')->with('getListTypeOfProduct',$getListTypeOfProduct)->with('getProductByID',$getProductByID)->with('getAuctionByIDProduct',$getAuctionByIDProduct);
    }

    public function test(){
    	$param_array = array(
            'giadau' => 200000,
            'maphieudaugia' => 40
        );
        $param = json_encode($param_array);
        $url = 'http://localhost:3000/phieudaugia/capnhat/giahientai/';
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        $result = curl_exec($ch);
        curl_close($ch);
        $result_decode = json_decode($result);
        dd($result_decode);
        return $result_decode;
    }

    public function auctionProduct(Request $request, $id){
    	if($request->isMethod('post')){
    		if((Session::has('name'))){
    			// Lấy mã phiên đấu giá bằng mã sản phẩm <<<< QUAN TRỌNG >>>>
    			$getAuctionByIDProduct = $this->getAuctionByIDProduct($id);
// BIẾN NÀY CỰC KÌ QUAN TRỌNG TRONG SUỐT LUỒNG NÀY
    			$auction_id = $getAuctionByIDProduct->maphiendaugia;
    			// Tạo các bieesnt để lưu những thông tin cần thiết
    			$name = Session::get('name');
    			$product_id = $id;
    			$currency = $request->input('txtAuction');
    			// B1: Tạo phiếu đấu giá
    			// hàm này truyền vào maphiendaugia và trả về giá cao nhất trong phiên (BẢNG COUPON)
    			// Nếu giá nhập vào mà lớn hơn giá max ->>>>> cập nhật tinhtrangphieu thành 2, các phiếu còn lại trong phiên thành 1
    			// sau đó cập nhật maphieuthang trong PHIÊN -> macoupon hiện tại
    			$max_currency = $this->getMaxCurrencyCouponByAuction($auction_id);
    			if(intval($currency) > (int)$max_currency){
    				// GET MÃ TÀI KHOẢN BẰNG TÊN TÀI KHOẢN
    				$coupon_id='';
	    			$user_id = $this->getUserIDByUsername($name);
    				$checkExistsCouponByUserIDAndAuctionID = $this->checkExistsCouponByUserIDAndAuctionID($auction_id,$user_id);
    				if($checkExistsCouponByUserIDAndAuctionID == 0){
    					$this->createCoupon($product_id, $currency, $name);
    				}
    				else{
    					// GET ID phiếu hiện tại bằng mã tài khoản
	    				$coupon_id = $this->getCouponIDByUserID($user_id);
    					$this->updateCurrencyByCouponID($coupon_id,$currency);
    				}
    				$countCouponByAuctionID = $this->countCouponByAuctionID($auction_id);
    				if($countCouponByAuctionID == 1){

    				}
    				elseif($countCouponByAuctionID != 1){
    					$winner_current = $this->getWinnerCurrentByAuctionID($auction_id);
	    				// dd($winner_current);
	    				$this->updateStatusByCouponID($winner_current,1);
	    				$this->updateStatusByCouponID($coupon_id,2);
    				}
    				$this->updateAuctionWhenWin($auction_id);
    			}
    			// Nếu giá nhập vào nhỏ hoặc bằng -> lỗi
    			else{
    				dd('a');
    			}
    			return redirect()->back();

    		}
    		return redirect('/login');
    	}
    	// dd(Session::get('name'));
    }

    public function updateAuctionWhenWin($auction_id){
    	$getInfoWinnerCurrentByCouponID = $this->getInfoWinnerCurrentByCouponID($auction_id);
    	$currency = $getInfoWinnerCurrentByCouponID->giadau;
    	$coupon_id = $getInfoWinnerCurrentByCouponID->maphieudaugia;

    	$now = Carbon::now();
        $now->setTimezone('Asia/Bangkok');
        $now->addDays(2);

    	$param_array = array(
            'maphiendaugia' => $auction_id,
            'giahientai' => $currency,
            'maphieuthang' => $coupon_id,
            'thoigiandau' => $now->toDateTimeString()
        );
        $param = json_encode($param_array);
        $url = 'http://localhost:3000/phiendaugia/capnhatphieuthang/';
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        $result = curl_exec($ch);
        curl_close($ch);
        // dd($result);
        // $result_decode = json_decode($result)[0]->count;
        // return $result_decode;
    }

// getWinnerCurrentByAuctionID trả ra mã phiếu thắng trong phiên hiện tại
    public function getInfoWinnerCurrentByCouponID($auction_id){
    	$coupon_id = $this->getWinnerCurrentByAuctionID($auction_id);
    	$url = 'http://localhost:3000/phieudaugia/'.$coupon_id;
	    $ch = curl_init($url);
	    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	    $result = curl_exec($ch);
	    curl_close($ch);
	    $result_decode = json_decode($result);
	    return $result_decode[0];
    }

    public function countCouponByAuctionID($auction_id){
    	$param_array = array(
            'maphiendaugia' => $auction_id
        );
        $param = json_encode($param_array);
        $url = 'http://localhost:3000/phieudaugia/soluong/maphieudaugia/';
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        $result = curl_exec($ch);
        curl_close($ch);
        $result_decode = json_decode($result)[0]->count;
        return $result_decode;
    }


    public function checkExistsCouponByUserIDAndAuctionID($auction_id,$user_id){
    	$param_array = array(
            'maphiendaugia' => $auction_id,
            'mataikhoan' => $user_id
        );
        $param = json_encode($param_array);
        $url = 'http://localhost:3000/phieudaugia/kiemtratontai/maphieudaugia/';
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        $result = curl_exec($ch);
        curl_close($ch);
        $result_decode = json_decode($result)[0]->count;
        return $result_decode;
    }

    public function updateCurrencyByCouponID($coupon_id,$currency){
    	$param_array = array(
            'giadau' => $currency,
            'maphieudaugia' => $coupon_id
        );
        $param = json_encode($param_array);
        $url = 'http://localhost:3000/phieudaugia/capnhat/giahientai/';
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        $result = curl_exec($ch);
        curl_close($ch);
    }

// Truyền vào ID phiên để tìm ra người chiến thắng hiện tại của phiên này (id là mã phiên)
    public function getWinnerCurrentByAuctionID($auction_id){
    	$url = 'http://localhost:3000/phieudaugia/nguoichienthang/maphien/'.$auction_id;
	    $ch = curl_init($url);
	    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	    $result = curl_exec($ch);
	    curl_close($ch);
	    $result_decode = json_decode($result)[0]->maphieudaugia;
	    return $result_decode;
    }

// LẤY ID PHIẾU BẰNG MÃ TÀI KHOẢN
    public function getCouponIDByUserID($user_id){
    	// dd($user_id);
    	$url = 'http://localhost:3000/phieudaugia/mataikhoan/'.$user_id;
	    $ch = curl_init($url);
	    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	    $result = curl_exec($ch);
	    curl_close($ch);
	    // dd($result);
	    $result_decode = json_decode($result)[0]->maphieudaugia;
	    return $result_decode;
    }

// CẬP NHẬT STATUS COUPON BẰNG MAPHIEU
    public function updateStatusByCouponID($coupon_id, $status){
    	$param_array = array(
            'tinhtrang' => $status
        );
        $param = json_encode($param_array);
        $url = 'http://localhost:3000/phieudaugia/capnhattinhtrang/maphieudaugia/'.$coupon_id;
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        $result = curl_exec($ch);
        curl_close($ch);
    }


// Truyền vào mã phiên đấu giá và cập nhật tình trang phiếu đấu giá (id là mã phiên)
    public function updateStatusCoupon($auction_id, $status){
    	$param_array = array(
            'tinhtrang' => $status
        );
        $param = json_encode($param_array);
        $url = 'http://localhost:3000/phieudaugia/capnhattinhtrang/maphiendaugia/'.$auction_id;
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        $result = curl_exec($ch);
        curl_close($ch);
    }

    public function createCoupon($id, $currency, $name){
    	$getAuctionByIDProduct = $this->getAuctionByIDProduct($id);
    	$auction_id = $getAuctionByIDProduct->maphiendaugia;
    	$user_id = $this->getUserIDByUsername($name);
    	$currency = $currency;

    	$param_array = array(
            'maphiendaugia' => $auction_id,
            'mataikhoan' => $user_id,
            'giadau' => $currency,
            'matinhtrangphieudaugia' => 2
        );

        $param = json_encode($param_array);
        $url = 'http://localhost:3000/phieudaugia/';
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        $result = curl_exec($ch);
        curl_close($ch);

    	// dd($auction_id);
    }

    public function getMaxCurrencyCouponByAuction($aution_id){
    	$url = 'http://localhost:3000/phieudaugia/giacaonhat/maphien/'.$aution_id;
	    $ch = curl_init($url);
	    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	    $result = curl_exec($ch);
	    curl_close($ch);
	    $result_decode = json_decode($result)[0]->max;
	    // dd($result_decode);
	    return $result_decode;
    }

    // hàm này truyền vào 1 name (tên hiển thị) -> trả ra ID user đó
    public function getUserIDByUsername($name){
    	
	    $param_array = array(
            'tenhienthi' => $name
        );

        $param = json_encode($param_array);
        $url = 'http://localhost:3000/taikhoan/thongtin/tenhienthi';
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        $result = curl_exec($ch);
        curl_close($ch);
        $result_decode = json_decode($result)[0]->mataikhoan;
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

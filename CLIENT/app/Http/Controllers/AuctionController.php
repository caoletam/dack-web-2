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

    public function create(Request $request){
    	if($request->isMethod('post')){

    		$now = Carbon::now();
	        $now->setTimezone('Asia/Bangkok');
	        $now->addDays($request->input('txtTime'));

    		$param_array = array(
                'masanpham' => $request->input('cbName'),
                'thoigiandau' => $now->toDateTimeString(),
                'giathapnhat' => $request->input('txtCurrency'),
                'giahientai' => $request->input('txtCurrency'),
                'maphieuthang' => 0,
                'matinhtrangphiendaugia' => '1'
            );
            $param = json_encode($param_array);
            $url = $this->host.'/phiendaugia/';
            $ch = curl_init($url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
            $result = curl_exec($ch);
            curl_close($ch);
            
            $id = json_decode($result)[0]->masanpham;
            $status = json_decode($result)[0]->matinhtrangphiendaugia;

            $this->updateStatusProduct($id,$status);
            return redirect('admin/auction');
    	}
    	$getListProductNotExistAuction = $this->getListProductNotExistAuction();
    	$getListAuction = $this->getListAuction();
    	return view('admin.auction.add')->with('getListProductNotExistAuction',$getListProductNotExistAuction)->with('getListAuction',$getListAuction);
    }

    public function delete(Request $request, $id){
    	if($request->isMethod('post')){

    		// Cập nhật bảng Product trước đã rồi xóa chứ k xóa mát r lấy đâu ra id nữa mà kiếm
    		$idProduct = $this->getIDProduct($id);
    		$this->updateStatusProduct($idProduct,2);


    		$url = $this->host.'/phiendaugia/'.$id;
    		$ch = curl_init($url);
    		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    		$result = curl_exec($ch);
    		// dd($result);
    		curl_close($ch);



    		return redirect('admin/auction');
    	}
    }

    // $id này là id của phiên đấu giá
    public function updateStatus(Request $request,$id){
    	if($request->isMethod('post')){
    		// dd($request->all());
    		$param_array = array(
                'status' => $request->input('txtStatus')
            );
            $param = json_encode($param_array);
            $url = $this->host.'/phiendaugia/capnhattinhtrang/'.$id;
            $ch = curl_init($url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
            $result = curl_exec($ch);
            curl_close($ch);

            // Lấy mã sản phẩm ra để còn cập nhật bảng sản phẩm nữa chứ
            $id_product = json_decode($result)[0]->masanpham;
            $status = $request->input('txtStatus');
            $this->updateTimeAuction($id,$status);
            $this->updateStatusProduct($id_product,$status);
            return redirect('admin/auction');
    	}
    	return redirect('admin/auction');
    }

    public function updateTimeAuction($id,$status){

    	$time = '';
// Lấy time
    	$default_time = Carbon::now();
        $default_time->setTimezone('Asia/Bangkok');

        $now = Carbon::now();
        $now->setTimezone('Asia/Bangkok');
        $now->addDays(2);

    	if($status == 1){
    		$time = $now->toDateTimeString();
    	}
    	elseif($status == 2){
    		$time = $default_time->toDateTimeString();
    	}

    	$param_array = array(
            'time' => $time
        );
        $param = json_encode($param_array);
        $url = $this->host.'/phiendaugia/capnhatthoigian/'.$id;
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        $result = curl_exec($ch);
        curl_close($ch);
    }


    // Hàm này gọi ra khi nhấn nút Update (active/deactive)
    // Nếu ấn 1 -> sp: 1, nếu ấn 2 -> sp: 0
    // Sử dụng API capnhattrangthai/:id với ID là mã SP
    public function updateStatusProduct($id,$status){
    	$status_product = '';
    	if($status == 1){
    		$status_product = '1';
    	}
    	else{
    		$status_product = '0';
    	}

    	$param_array = array(
            'status' => $status_product
        );
        $param = json_encode($param_array);
        $url = $this->host.'/sanpham/capnhattrangthai/'.$id;
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        $result = curl_exec($ch);
        curl_close($ch);
    }

    public function getListProduct(){
    	$url = $this->host.'/sanpham/';
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $result = curl_exec($ch);
        curl_close($ch);
        $result_decode = (array) json_decode($result);
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

    public function getListCoupon(){
    	$url = $this->host.'/phieudaugia/';
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $result = curl_exec($ch);
        curl_close($ch);
        $result_decode = (object) json_decode($result);
        // dd($result_decode);
        return $result_decode;
    }

    public function getListAuctionStatus(){
    	$url = $this->host.'/tinhtrangphiendaugia/';
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $result = curl_exec($ch);
        curl_close($ch);
        $result_decode = (object) json_decode($result);
        // dd($result_decode);
        return $result_decode;
    }

    public function getListProductNotExistAuction(){
    	$url = $this->host.'/sanpham/danhsachkhongthuocphiendaugia';
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $result = curl_exec($ch);
        curl_close($ch);
        $result_decode = (object) json_decode($result);
        // dd($result_decode);
        return $result_decode;
    }

    // Hàm này sẽ get masanpham theo id phiên đấu giá (cần truyền vào id phiên đấu giá)
    public function getIDProduct($id){
    	$url = $this->host.'/phiendaugia/masanpham/sanpham/'.$id;
    	$ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $result = curl_exec($ch);
        curl_close($ch);
        $idProduct = ((array) json_decode($result))[0]->masanpham;
        return $idProduct;
    }

    public function test(){
    	$url = $this->host.'/phiendaugia/masanpham/sanpham/27';
    	$ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $result = curl_exec($ch);
        curl_close($ch);
        $result_decode = ((array) json_decode($result))[0]->masanpham;
        dd($result_decode);
        return $result_decode;
    }
}

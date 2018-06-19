<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

class ProductController extends Controller
{
    //
    public function index(){
    	$result_decode_product = $this->getListProduct();
        $result_decode_type_of_product = $this->getListTypeOfProduct();
        $getListAuction = $this->getListAuction();
        return view('admin.product.index')->with('result_decode_product',$result_decode_product)->with('result_decode_type_of_product',$result_decode_type_of_product)->with('getListAuction',$getListAuction);
    }

    public function create(Request $request){
    	if($request->isMethod('post')){
    		$param_array = array(
                'tensanpham' => $request->input('txtName'),
                'maloaisanpham' => $request->input('cbType'),
                'dacta' => $request->input('txtDescription'),
                'hinhdaidien' => $request->input('txtLinkAvatar'),
                'tinhtrang' => '0'
            );
            $param = json_encode($param_array);
            $url = $this->host.'/sanpham/';
            $ch = curl_init($url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
            $result = curl_exec($ch);
            curl_close($ch);
            return redirect('admin/product');
    	}
    	$result_decode_type_of_product = $this->getListTypeOfProduct();
    	return view('admin.product.add')->with('result_decode_type_of_product',$result_decode_type_of_product);
    }

    public function update(Request $request, $id){
    	if($request->isMethod('post')){
    		$param_array = array(
                'tensanpham' => $request->input('txtName'),
                'maloaisanpham' => $request->input('cbType'),
                'dacta' => $request->input('txtDescription'),
                'hinhdaidien' => $request->input('txtLinkAvatar'),
                'tinhtrang' => '0'
            );
            $param = json_encode($param_array);
            $url = $this->host.'/sanpham/'.$id;
            $ch = curl_init($url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
            $result = curl_exec($ch);
            curl_close($ch);
            return redirect('admin/product');

    	}
    	$result_product_decode = $this->getProduct($id);
    	$result_decode_type_of_product = $this->getListTypeOfProduct();
    	return view('admin.product.edit')->with('result_product_decode',$result_product_decode)->with('result_decode_type_of_product',$result_decode_type_of_product);
    }

    public function delete(Request $request, $id){
    	if($request->isMethod('post')){
    		$url = $this->host.'/sanpham/'.$id;
    		$ch = curl_init($url);
    		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    		$result = curl_exec($ch);
    		curl_close($ch);
    		return redirect('admin/product');
    	}
    }

    public function getListProduct(){
        $url = $this->host.'/sanpham/';
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $result = curl_exec($ch);
        curl_close($ch);
        $result_decode = (object) json_decode($result);
        // dd($result_decode);
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

    public function getProduct($id){
        $url = $this->host.'/sanpham/'.$id;
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $result = curl_exec($ch);
        curl_close($ch);

        $result_decode = (array) json_decode($result);
        // dd($result_decode[0]->masanpham);
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

    public function updateStatus(Request $request, $id){
        if($request->isMethod('post')){
            // dd($request->all());
            // dd($request->input('txtStatus'));

        // Cập nhật sản phẩm
            $param_array = array(
                'status' => $request->input('txtStatus')
            );
            $param = json_encode($param_array);
            // dd($param);
            $url = $this->host.'/sanpham/capnhattrangthai/'.$id;
            $ch = curl_init($url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
            $result = curl_exec($ch);
            curl_close($ch);
        // Kết thúc cập nhật sản phẩm

        // Lấy ra mã sản phẩm
            $result_masanpham_decode = json_decode($result)[0]->masanpham;

        // Gọi hàm xử lí Phiên đấu giá
            $this->handleAuction($result_masanpham_decode);
            // dd($result_masanpham_decode);
            return redirect('admin/product');
        }
        return redirect('admin/product');
    }

    // Hàm xử lí phiên đấu giá khi ấn nút Update Sản phẩm
    // ID là mã sản phẩm
    // tình trạng sản phẩm
    public function handleAuction($id){

        // LẤY TIME 

        $default_time = Carbon::now();
        $default_time->setTimezone('Asia/Bangkok');

        $now = Carbon::now();
        $now->setTimezone('Asia/Bangkok');
        $now->addDays(2);

        // dd($now->toDateTimeString());

        $count = $this->checkExistsAuction($id);
        // dd($count);
        if($count != 0){
            $statusAuction = $this->getAuctioStatus($id);
        // Nếu == 1 -> đang đấu -> cập nhật thành 2
            if($statusAuction == 1){
                $this->updateStatusAuction($id,2);
            }
            elseif($statusAuction == 2){
                $this->updateStatusAuction($id,1);
            }
        }
        else if($count == 0){
            $this->createAuction($id);
        }
    }


    // ID này là mã sản phẩm kiểm tra xem trong phiên đấu giá đã tồn tại chưa
    // Hàm này cần return ra check: nếu = 1 -> đã tồn tại, = 0 -> chưa tồn tại (type int)
    public function checkExistsAuction($id){
        $param_array = array(
                'masanpham' => $id // ID là mã sản phẩm
        );

        $param = json_encode($param_array);
        // dd($param);
        $url = $this->host.'/phiendaugia/kiemtratontai/';
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        $result = curl_exec($ch);
        curl_close($ch);
        $count = (int) json_decode($result)[0]->count;
        return $count;
    }

    // Hàm này gọi khi đã tồn tại (Exists = 1)
    // Hàm này cần truyền vào $id là mã sản phẩm, để lấy được tình trạng phiên đấu giá
    // Hàm này trả về tình trạng phiên đấu giá 
    public function getAuctioStatus($id){

        $url = $this->host.'/phiendaugia/tinhtrangphiendaugia/sanpham/'.$id;
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $result = curl_exec($ch);
        curl_close($ch);

        $status = (int) json_decode($result)[0]->matinhtrangphiendaugia;
        return $status;
    }

    // Hàm này cần truyền vào $id: mã sản phẩm, $status: tình trạng phiên đấu giá 1 hoặc 2
    public function updateStatusAuction($id,$status){

        // LẤY TIME 

        $default_time = Carbon::now();
        $default_time->setTimezone('Asia/Bangkok');

        $now = Carbon::now();
        $now->setTimezone('Asia/Bangkok');
        $now->addDays(2);

        $auctionTime = '';
        if($status==2){
            $auctionTime = $default_time->toDateTimeString();
        }
        elseif($status==1){
            $auctionTime = $now->toDateTimeString();
        }

        // Cập nhật
        $param_array = array(
            'masanpham' => $id, // ID là mã sản phẩm
            'thoigiandau' => $auctionTime, //Ngày hiện tại + 2 ngày
            'giathapnhat' => 1000,
            'giahientai' => 1000,
            'maphieuthang' => 0,
            'matinhtrangphiendaugia' => $status
        );
        $param = json_encode($param_array);
        // dd($param);
        $url = $this->host.'/phiendaugia/capnhatphiendaugia/';
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        $result = curl_exec($ch);
        curl_close($ch);
    }

    // Hàm này là hàm thêm mới phiên đấu giá, hàm này cần truyền vào $id là mã sản phẩm
    public function createAuction($id){

        $now = Carbon::now();
        $now->setTimezone('Asia/Bangkok');
        $now->addDays(2);

        $param_array = array(
            'masanpham' => $id,
            'thoigiandau' => $now->toDateTimeString(), //Ngày hiện tại + 2 ngày
            'giathapnhat' => 1000,
            'giahientai' => 1000,
            'maphieuthang' => 0,
            'matinhtrangphiendaugia' => 1
        );
        $param = json_encode($param_array);
        $url = $this->host.'/phiendaugia/';
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        $result = curl_exec($ch);
        curl_close($ch);
    }

}

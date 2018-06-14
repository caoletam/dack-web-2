<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

class ProductController extends Controller
{
    //
    public function getListProduct(){
    	$url = 'http://localhost:3000/sanpham/';
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

    public function getProduct($id){
    	$url = 'http://localhost:3000/sanpham/'.$id;
    	$ch = curl_init($url);
    	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    	$result = curl_exec($ch);
    	curl_close($ch);

    	$result_decode = (array) json_decode($result);
    	// dd($result_decode[0]->masanpham);
    	// dd($result_decode);
        return $result_decode;
    }

    public function index(){
    	$result_decode_product = $this->getListProduct();
        $result_decode_type_of_product = $this->getListTypeOfProduct();
        return view('admin.product.index')->with('result_decode_product',$result_decode_product)->with('result_decode_type_of_product',$result_decode_type_of_product);
    }

    public function create(Request $request){
    	if($request->isMethod('post')){
    		// dd($request->all());
    		$param_array = array(
                'tensanpham' => $request->input('txtName'),
                'maloaisanpham' => $request->input('cbType'),
                'dacta' => $request->input('txtDescription'),
                'hinhdaidien' => $request->input('txtLinkAvatar'),
                'tinhtrang' => '0'
            );
            $param = json_encode($param_array);
            $url = 'http://localhost:3000/sanpham/';
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
            $url = 'http://localhost:3000/sanpham/'.$id;
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
    		$url = 'http://localhost:3000/sanpham/'.$id;
    		$ch = curl_init($url);
    		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    		$result = curl_exec($ch);
    		curl_close($ch);
    		return redirect('admin/product');
    	}
    }

    public function updateStatus(Request $request, $id){
        if($request->isMethod('post')){
            // dd($request->all());
            // dd($request->input('txtStatus'));
            $param_array = array(
                'status' => $request->input('txtStatus')
            );
            $param = json_encode($param_array);
            // dd($param);
            $url = 'http://localhost:3000/sanpham/capnhattrangthai/'.$id;
            $ch = curl_init($url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
            $result = curl_exec($ch);
            curl_close($ch);
            $result_tinhtrang_decode = json_decode($result)[0]->tinhtrang; // trả về mã sản phẩm + tình trạng, nếu tình trạng = 1, -> thêm phiên đấu giá với mã sản phẩm đó
            $result_masanpham_decode = json_decode($result)[0]->masanpham;

            $createAuction = $this->createAuction($result_masanpham_decode,$result_tinhtrang_decode);
            // dd($result_masanpham_decode);
            return redirect('admin/product');
        }
        return redirect('admin/product');
    }

    public function createAuction($id,$status){

        // get thời gian hiện tại trong

        $now = Carbon::now();
        $now->setTimezone('Asia/Bangkok');
        $now->addDays(2);
        // dd($now->toDateTimeString());

        $param_array = array(
            'masanpham' => $id,
            'thoigiandau' => $now->toDateTimeString(), //Ngày hiện tại + 2 ngày
            'giathapnhat' => 1000,
            'giahientai' => 1000,
            'maphieuthang' => '1',
            'matinhtrangphiendaugia' => $status
        );
        $param = json_encode($param_array);
        $url = 'http://localhost:3000/phiendaugia/';
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        $result = curl_exec($ch);
        curl_close($ch);
        dd($result);
    }
}

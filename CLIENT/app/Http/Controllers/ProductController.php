<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
                'hinhdaidien' => $request->input('txtLinkAvatar')
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
                'hinhdaidien' => $request->input('txtLinkAvatar')
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
}

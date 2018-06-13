<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    //
    public function getListImage(){
    	$url = 'http://localhost:3000/hinh/';
    	$ch = curl_init($url);
    	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    	$result = curl_exec($ch);
    	curl_close($ch);
    	$result_decode = (object) json_decode($result);
    	// dd($result_decode);
        return $result_decode;
    }

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

    public function getImage($id){
    	$url = 'http://localhost:3000/hinh/'.$id;
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
        $result_decode_image = $this->getListImage();
        return view('admin.image.index')->with('result_decode_product',$result_decode_product)->with('result_decode_image',$result_decode_image);
    }

    public function create(Request $request){
    	if($request->isMethod('post')){
    		// dd($request->all());
    		$param_array = array(
                'duongdan' => $request->input('txtLink'),
                'masanpham' => $request->input('cbName')
            );
            $param = json_encode($param_array);
            $url = 'http://localhost:3000/hinh/';
            $ch = curl_init($url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
            $result = curl_exec($ch);
            curl_close($ch);
            return redirect('admin/image');
    	}
    	$result_decode_product = $this->getListProduct();
    	return view('admin.image.add')->with('result_decode_product',$result_decode_product);
    }

    public function update(Request $request, $id){
    	if($request->isMethod('post')){
    		$param_array = array(
                'duongdan' => $request->input('txtLink'),
                'masanpham' => $request->input('cbName')
            );
            $param = json_encode($param_array);
            $url = 'http://localhost:3000/hinh/'.$id;
            $ch = curl_init($url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
            $result = curl_exec($ch);
            curl_close($ch);
            return redirect('admin/image');

    	}
    	$result_decode_image = $this->getImage($id);
    	$result_decode_product = $this->getListProduct();
    	return view('admin.image.edit')->with('result_decode_image',$result_decode_image)->with('result_decode_product',$result_decode_product);
    }

    public function delete(Request $request, $id){
    	if($request->isMethod('post')){
    		$url = 'http://localhost:3000/hinh/'.$id;
    		$ch = curl_init($url);
    		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    		$result = curl_exec($ch);
    		curl_close($ch);
    		return redirect('admin/image');
    	}
    }
}

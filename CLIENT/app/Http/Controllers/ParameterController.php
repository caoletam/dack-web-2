<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParameterController extends Controller
{
    //
    public function getListParameter(){
    	$url = $this->host.'/thamso/';
    	$ch = curl_init($url);
    	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    	$result = curl_exec($ch);
    	curl_close($ch);
    	$result_decode = (object) json_decode($result);
    	// dd($result_decode);
        return $result_decode;
    }

    public function getParameter($id){
    	$url = $this->host.'/thamso/'.$id;
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
    	$result_decode_parameter = $this->getListParameter();
        return view('admin.parameter.index')->with('result_decode_parameter',$result_decode_parameter);
    }

    public function create(Request $request){
    	if($request->isMethod('post')){
    		// dd($request->all());
    		$param_array = array(
                'tenthamso' => $request->input('txtName'),
                'giatri' => $request->input('txtValue')
            );
            $param = json_encode($param_array);
            $url = $this->host.'/thamso/';
            $ch = curl_init($url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
            $result = curl_exec($ch);
            curl_close($ch);
            return redirect('admin/parameter');
    	}
    	return view('admin.parameter.add');
    }

    public function update(Request $request, $id){
    	if($request->isMethod('post')){
    		// dd(gettype(floatval($request->input('cbName'))));
    		$param_array = array(
                'tenthamso' => $request->input('txtName'),
                'giatri' => floatval($request->input('txtValue'))
            );
            $param = json_encode($param_array);
            $url = $this->host.'/thamso/'.$id;
            $ch = curl_init($url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
            $result = curl_exec($ch);
            curl_close($ch);
            return redirect('admin/parameter');

    	}
    	$result_decode_parameter = $this->getParameter($id);
    	return view('admin.parameter.edit')->with('result_decode_parameter',$result_decode_parameter);
    }

    public function delete(Request $request, $id){
    	if($request->isMethod('post')){
    		$url = $this->host.'/thamso/'.$id;
    		$ch = curl_init($url);
    		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    		$result = curl_exec($ch);
    		curl_close($ch);
    		return redirect('admin/parameter');
    	}
    }
}

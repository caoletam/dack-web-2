<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function test(){
    	$url = 'http://localhost:3000/thamso/';

    	$ch = curl_init($url);

    	CURL_SETOPT($ch,CURLOPT_RETURNTRANSFER, true);

    	$result = curl_exec($ch);

    	curl_close($ch);
    	$result_decode = json_decode($result);

    	// dd($result_decode[0]);

    	return view('test')->with('result_decode',$result_decode);
    }

    public function test1(){

    }
}

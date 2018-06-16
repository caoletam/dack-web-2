<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserIndexController extends Controller
{
    //
    public function index(){
    	return view('user.product.index');
    }
}

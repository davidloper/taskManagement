<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use Url;

class IndexController extends Controller
{	
	function __construct(){
		$this->middleware('guest');
	}
    function index(){
    	return view('index');
    }
}

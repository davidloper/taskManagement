<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;

use Auth;

class CommentController extends Controller
{	
	public function index(){
		// dd(1234);
	}
    public function store(Request $request){
    	
    	Comment::create($request->all() + ['user_id' => Auth::user()->id]);

    	return redirect()->back()->with('success');
    }
}

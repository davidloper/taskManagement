<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\ProjectUser;
use App\User;
use App\InviteUser;

use Auth;

class SettingController extends Controller
{
    function index(){
        return view('pages.settings.index')->with('user',Auth()->user());
    }
    function editUserInfo (Request $request){
        $user = Auth::user();
        switch($request->type){
            case 'username':
                $request->validate([
                    $request->type => 'required|min:6'
                ]);
                break;
            case 'email':
                $request->validate([
                    $request->type => 'required|email'
                ]);
                break;
            case 'password':
                if($request->password == $request->confirmPassword){
                    $request->validate([
                        $request->type => 'required|min:6'
                    ]);
                }else{
                    return redirect()->back()->with('error',' Password does not match');
                }
                break;
        }
        if($request->type == 'email'){
            $user->{$request->type} = Hash::make($request->{$request->type});
        }else{
            $user->{$request->type} = $request->{$request->type};
        }

        $user->save();
        $successMsg = ucfirst($request->type).' Successfully Saved'; 
        return redirect()->back()->with('success',$successMsg);
    }
}

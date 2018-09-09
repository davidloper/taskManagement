<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ProjectMessage;

use Auth;

class ProjectMessageController extends Controller
{
    function index (){

      $projectMessages = ProjectMessage::where('project_id',Auth::user()->project_id)->get();
      return view('pages.admins.project_messages.index_create_edit',compact('projectMessages'));
    }
    function store(Request $request){
      foreach($request->id as $key => $id){
        if($id == 0){
          ProjectMessage::create([
            'project_id' => Auth::user()->project_id,
            'message' => $request->message[$key],
          ]);
        }else{
          $projectMessage = ProjectMessage::find($id);
          $projectMessage->message = $request->message[$key];
          $projectMessage->update();
        }
      }
      return redirect()->back();
    }
}

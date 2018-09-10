<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ProjectMessage;

use Auth;

class ProjectMessageController extends Controller
{
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

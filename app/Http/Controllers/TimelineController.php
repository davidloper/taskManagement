<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timeline;

use Auth;

class TimelineController extends Controller
{
    function index(){
      $timelines = Timeline::where('project_id',Auth::user()->project_id)->orderBy('created_at','desc')->get();
      $timelines = $timelines->map(function($value){
        $value->date = ($value->created_at)->format('d M Y');
        return $value;
      })->groupBy('date');

      return view('pages.timelines.index',compact('timelines'))->with('now',now());
    }
}

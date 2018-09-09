<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timeline;

class TimelineController extends Controller
{
    function index(){
      $timelines = Timeline::orderBy('created_at','desc')->get();
      $timelines = $timelines->map(function($value){
        $value->date = ($value->created_at)->format('d M Y');
        return $value;
      });
      $timelines = $timelines->groupBy('date');
      return view('pages.timelines.index',compact('timelines'));
    }
}

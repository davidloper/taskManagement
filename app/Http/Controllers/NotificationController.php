<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Notification;

use Auth;

class NotificationController extends Controller
{
    function markAsSeen(){
    	$notification = Notification::where('user_id',Auth::id())->update(['seen' => 1]);

    	return redirect()->back();
    }
}

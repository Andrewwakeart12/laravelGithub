<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
class EventApiController extends Controller
{
    public function calendarEvents(){
        $eventos = Event::get(['title','date']);
        return response()->json(["Events"=> $eventos]);
    }
}

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersApiController extends Controller
{
    public function index(){
    	return response()->json(User::all());
    }
     public function store(Request $request){
        $user = User::create($request->all());
        return response()->json([
            'status'=>'succes',
            'user'=> $user
        ]);
     }
}

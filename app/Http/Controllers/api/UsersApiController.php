<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Role;

class UsersApiController extends Controller
{
    public function index(){
        $users= User::all();
        foreach($users as $user){
            $user->role = Role::find($user->role_id);
        }
        return response()->json($users);
    }
    public function options(){
        $options = Role::pluck('name','id')->all();
        return $options;
    }
     public function store(Request $request){
        $user = User::create($request->all());
     }
}

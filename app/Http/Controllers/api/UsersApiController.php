<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class UsersApiController extends Controller
{
    public function index(){
        $users= User::all();
        foreach($users as $user){
            $user->role = Role::find($user->role_id);
        }
        return response()->json($users);
    }
    public function getRoles(){
        $options = Role::all(['id','name']);
        /*RECUERDA CONVERTIR EL OBJETO EN STRING ANTES DE HACER MODIFICACIONES EN LOS PERMISOS DE LOS ROLES
        $options = $options->toArray();
        $options['permissions']['posts']['create'] = false;*/

        return $options;

    }
     public function store(Request $request){
        $permissions= Auth::user()->role->permissions;
        if($permissions['users']['create']){
            $user=$request->all();
            $user['api_token'] = Str::random(60);

            $user = User::create($user);
            return response()->json(['Success'=> 'User Created']);
        }else{
            return response()->json(['Error'=> 'You dont have permission to create users']);

        }
        }
     public function update(Request $request, $id)
     {
         $permissions= Auth::user()->role->permissions;
         if($permissions['users']['update']){
            $user = User::find($id);
            $user->update($request->all());

            return response()->json(['Success'=>'User updated']);

         }else{
             return response()->json(['Success' => 'No tienes permisos para cambiar la informacion de usuario']);
         }


     }
     public function getUsersInfo(){

            $users = User::all(['email', 'id','role_id']);
            foreach($users as $user){
                $user->role = Role::find($user->role_id);
                $user->tasks = $user->tasks;
                $user->isThisUser = $user->isThisUser($user->id);
            }
            return $users;
     }
     public function destroy($id){

        $permissions= Auth::user()->role->permissions;
         if($permissions['users']['delete']){
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(['Success'=> 'User deleted']);
         }else{
            return response()->json(['Error'=> 'You cant delete users']);
         }
         }
}

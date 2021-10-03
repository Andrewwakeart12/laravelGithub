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
     public function getThisUserId(){
        $userID=Auth::user()->id;
         return response()->json($userID);
     }
     public function getUsersInfo(){

            $users = User::all(['email', 'id','role_id']);
            $finalUsers = [];
            foreach($users as $user){
                if($user->isAdmin()){
                    $user->role = Role::find($user->role_id);
                    $user->tasks = $user->tasks;
                    $user->isThisUser = $user->isThisUser($user->id);
                    array_push($finalUsers, $user);
                }
               }
            return $finalUsers;
     }
     public function getNotifications(){
         $Dbnotifications = Auth::user()->notifications()->orderBy('created_at')->limit(4)->get();
         $notifications = [];
         foreach ($Dbnotifications as $notification){
             $id_noty = $notification->id;
             $data = $notification->data;
             $data['id_noty']= $id_noty;
             $data['isRead'] = $notification->read_at;
             array_push($notifications,$data);

         }
         return response()->json($notifications);
     }

     public function readNotifications($notifications){
          $notification= Auth::user()->notifications()->where(['id' => $notifications])->get();
                $notification->markAsRead();
             return response()->json($notification);
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

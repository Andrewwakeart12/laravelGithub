<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $directory = "/images/";
    protected $fillable = [
        'username',
        'firstName',
        'lastName',
        'email',
        'password',
        'role_id',
        'is_active',
        'photo_id',
        'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

public function posts(){
    return $this->hasMany('App\Models\Post');
}
public function role(){
    return $this->belongsTo('App\Models\Role');
}
public function photo(){
    return $this->belongsTo('App\Models\Photo');
}
public function isAdmin(){
    if($this->role->permissions['especials']['isAdmin']){
    return true;
}else {
    return false;
}
}
public function getPhotoFileDir(){
    return $this->directory . $this->photo->file;
}
public function isThisUser($userID){
    if($userID == Auth::user()->id){
        return true;
    }else{
        return false;
    }

}
public function tasks(){
    return $this->hasMany('App\Models\Task');
}

public function receiveBroadcastNotificationOn(){
    return 'notifications-tasks.' . $this->id;
}
public function canJoinRoom($roomId){
    if(Auth::user() != null){
        return true;
    }
}
public function getChannel($thisUserId,$otherUserId){
    $firstPossiblyRelation = DB::table('conversations')->where(['first_user_id'=>$thisUserId, 'second_user_id'=> $otherUserId])->get();
    $secondPossiblyRelation = DB::table('conversations')->where(['first_user_id'=> $otherUserId, 'second_user_id'=> $thisUserId])->get();

    //DB::table('conversations')->where(['first_user_id'=>1, 'second_user_id'=> 2])->get()
    if($firstPossiblyRelation->isEmpty() != true){
        return $firstPossiblyRelation[0]->id;
    }else if($secondPossiblyRelation->isEmpty() != true){
        return $secondPossiblyRelation[0]->id;
    }else{
        $newChat = Conversation::create(['first_user_id'=> $thisUserId , 'second_user_id'=> $otherUserId]);
        return $newChat->id;
    }
}
}

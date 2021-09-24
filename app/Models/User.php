<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
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
public function isAdmin(){
    if($this->role->permissions['especials']['isAdmin']){
    return true;
}else {
    return false;
}

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
}

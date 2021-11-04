<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    protected $fillable = ['user_id','group_conversations_id'];
    public function getUsersInGroup(){
        return $this->belongsToMany('App\Models\User', 'group_users','group_conversations_id','user_id');
    }
    use HasFactory;
}

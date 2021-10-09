<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Message;
class Conversation extends Model
{
    protected $fillable = ['first_user_id', 'second_user_id'];
    public function firstUser(){
        return $this->belongsTo('App\Models\User', 'first_user_id');
    }
    public function secondUser(){
        return $this->belongsTo('App\Models\User', 'second_user_id');
    }
    public function messagesInConversations(){
        return $this->hasMany('App\Models\Message','conversation_id');
    }
    use HasFactory;
}

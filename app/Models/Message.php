<?php

namespace App\Models;

use App\Listeners\MessageSended;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Conversation;
class Message extends Model
{
    use HasFactory;


    protected $fillable = ['text',
     'conversation_id',
     'user_id', 'conversation_type','group_conversations_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function conversation(){
        return $this->belongsTo(Conversation::class);
    }
}

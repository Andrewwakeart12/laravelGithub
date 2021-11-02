<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    protected $fillable = ['user_id','group_conversations_id'];

    use HasFactory;
}

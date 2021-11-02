<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupConversations extends Model
{
    protected $fillable = ['name','group_photo_id'];
    use HasFactory;
}

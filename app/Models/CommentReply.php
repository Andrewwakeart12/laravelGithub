<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    protected $fillable=['name', 'is_active','photo', 'author', 'email', 'body', 'comment_id',];

    use HasFactory;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id','title','body','categories'];
    protected $casts = [
        'categories'=>'array'
    ];
    use HasFactory;
}

//Post::create(['user_id'=>1,'title'=>'title','body'=>'text', 'categories'=> [1,2,3,4]])

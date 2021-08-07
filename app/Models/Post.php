<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id',
    'category_id',
    'photo_id',
    'title',
    'body',
];
public function photo(){
    return $this->belongsTo('App\Models\Photo');
}
public function user(){
    return $this->belongsTo('App\Models\User');
}
public function category(){
    return $this->belongsTo('App\Models\Category');
}
public function comments(){
    return $this->hasMany('App\Models\Comment');
}
    use HasFactory;
}


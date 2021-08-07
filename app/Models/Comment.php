<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['name', 'is_active', 'author', 'email', 'body',];
    public function reply(){
        return $this->hasMany('App\Models\CommentReply');
    }
    use HasFactory;


    /*
    Comment::create(['name'=>'Andrew', 'is_active'=>1, 'author'=>'Andre Wake', 'email'=>'andrewwkake.art@gmail.com', 'body'=>'como te digo la tierra es plana'])
    $table->increments('id');
            $table->integer('post_id')->unsigned()->index();
            $table->integer('is_active')->default(0);
            $table->string('author');
            $table->string('email');
            $table->text('body');
            $table->timestamps();
            */
}

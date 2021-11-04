<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupConversations extends Model
{
    protected $fillable = ['name','group_photo_id'];
    public $directory = "/images/";
    public function photo(){
        return $this->belongsTo('App\Models\Photo','group_photo_id');
    }
    public function getPhotoFileDir(){
    if($this->photo){
        if(file_exists(public_path() . $this->directory . $this->photo->file)){
            return $this->directory . $this->photo->file;
        }else{
            return asset('img/undraw_profile_1.svg');
        }
    }else{
        return asset('img/undraw_profile_1.svg');
    }
}
//DB::table('group_users')->where('group_conversations_id',1)->get('user_id')

    use HasFactory;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable =['event_name','event_description', 'event_start','event_end','user_id'];
    protected $dates = ['event_start', 'event_end'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    use HasFactory;
}

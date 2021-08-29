<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'titulo',
        'descripcion',
        'fecha',
     ];
     public $timestamps = false;

    use HasFactory;
}

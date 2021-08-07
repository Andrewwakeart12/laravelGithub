<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;

class Message extends Component
{
    public $comments;
    public $search;
    public function render()
    {
        return view('livewire.message', ['comments'=> Comment::where('author',$this->search)->get() ]);
    }
    public function refresh(){
        $this->comments = Comment::all();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->delete();
        Comment::create( ['photo'=>'/images/static.jpg','post_id'=>'1', 'is_active'=>'1', 'author'=>'Static Author' , 'email'=>'staticEmail@gmail.com', 'body'=>'Static Content of comment']);
    }
}

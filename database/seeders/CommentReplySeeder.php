<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\CommentReply;
class CommentReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comment_replies')->delete();
        CommentReply::create( ['name'=>'Static Name','photo'=>'/images/static.jpg','comment_id'=>'1', 'is_active'=>'1', 'author'=>'Static Author' , 'email'=>'staticEmail@gmail.com', 'body'=>'Static Content of comment']);

    }
}

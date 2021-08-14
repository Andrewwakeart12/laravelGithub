<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
class PostCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->delete();
        Post::create([
            'user_id'=>1,
            'category_id' => 1,
            'photo_id'=> 1,
            'title'=> 'prueba',
            'body'=> '1234567890'
        ]);
    }
}

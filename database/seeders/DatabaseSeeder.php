<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UsersCreateSeed;
use Database\Seeders\RoleTablesSeeder;
use Database\Seeders\PhotoSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\PostCommentSeeder;
use Database\Seeders\CommentSeeder;
use Database\Seeders\CommentReplySeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $users = new UsersCreateSeed();
       $roles = new RoleTablesSeeder();
       $photo = new PhotoSeeder();
       $category = new CategorySeeder();
       $post = new PostCommentSeeder();
       $comment= new CommentSeeder();
       $commentReply = new CommentReplySeeder();

       $roles->run();
       $this->command->info('roles table seeded');

       $users->run();
        $this->command->info('users table seeded');

        $photo->run();
        $this->command->info('photo table seeded');

        $category->run();
        $this->command->info('category table seeded');

        $post->run();
        $this->command->info('post table seeded');

        $comment->run();
        $this->command->info('comment table seeded');

        $commentReply->run();
        $this->command->info('commentReply table seeded');
    }
}

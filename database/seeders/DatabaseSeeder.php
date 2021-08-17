<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\ApiPostSeeder;
use Database\Seeders\PostsSeeder;
use Database\Seeders\CategoriesSeeder;
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
       $categories = new CategoriesSeeder();
       $posts = new PostsSeeder();

       $users->run();
       $this->command->info('users table seeded');
       $categories->run();
       $this->command->info('categories table seeded');
       $posts->run();
       $this->command->info('post table seeded');


    }
}

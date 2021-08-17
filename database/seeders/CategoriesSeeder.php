<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();
        $categories = [['name'=>'Pop'], ['name'=>'Dogs'],['name'=>'Drugs'],['name'=>'lifeStyle']];
        foreach($categories as $category){
            Category::create(['name' => $category['name']]);

        }

        }
}

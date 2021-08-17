<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Str;
class UsersCreateSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        User::create(array('name'=>'Edgar Maquina',
        'email'=>'andrewwake.art@gmail.com'
        ,'password'=>bcrypt('12345678'),
        'api_token' => Str::random(60),
    ));

    }
}

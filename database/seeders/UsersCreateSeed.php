<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
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
        User::create(array('username'=>'Obe','firstName'=>'Edgar','lastName'=>'Marquina Ruiz',
        'email'=>'andrewwake.art@gmail.com'
        ,'password'=>Hash::make('12345678')
        ,'role_id'=>1,
        'api_token' => Str::random(60),
    ));

    }
}

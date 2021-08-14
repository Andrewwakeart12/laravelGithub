<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
class UsersCreateSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        User::create(array('photo_id'=>1,'name'=>'Edgar Maquina','email'=>'andrewwake.art@gmail.com','password'=>bcrypt('12345678'),'is_active'=> 1,'role_id' => '1'));
    }
}

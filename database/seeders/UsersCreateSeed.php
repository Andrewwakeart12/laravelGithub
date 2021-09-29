<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Str;
use PhpJunior\LaravelVideoChat\Models\Group\Conversation\GroupConversation;
use PhpJunior\LaravelVideoChat\Models\Conversation\Conversation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        User::create(array('username'=>'Obe','firstName'=>'Edgar','lastName'=>'Marquina Ruiz',
        'email'=>'andrewwake.art@gmail.com'
        ,'password'=>Hash::make('12345678')
        ,'role_id'=>1,
        'api_token' => Str::random(60),
    ));
    User::create(array('username'=>'Obe','firstName'=>'Edgar','lastName'=>'Marquina Ruiz',
    'email'=>'obet@gmail.com'
    ,'password'=>Hash::make('12345678')
    ,'role_id'=>2,
    'api_token' => Str::random(60),
));
User::create(array('username'=>'Obe','firstName'=>'Edgar','lastName'=>'Marquina Ruiz',
'email'=>'edgarmarquinaruizobe@gmail.com'
,'password'=>Hash::make('12345678')
,'role_id'=>3,
'api_token' => Str::random(60),
));

$conversation = new Conversation();
$conversation->first_user_id = 1;
$conversation->second_user_id = 2;
$conversation->save();

$conversation->messages()->create([
    'user_id'   => 1,
    'text'      => 'Hello'
]);

$group = new GroupConversation();
$group->name = 'Test';
$group->save();

$group->users()->attach([ 1,2,3 ]);

    }
}

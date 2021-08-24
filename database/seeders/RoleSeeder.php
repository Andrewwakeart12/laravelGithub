<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        Role::create(['name'=>'administrator',
        'permissions' => [
            'posts'=> ['create' => true, 'read'=> 'true', 'update'=>'true', 'delete'=> 'true'] ,
            'roles'=> ['create' => true, 'read'=> 'true', 'update'=>'true', 'delete'=> 'true'] ,
            'users'=> ['create' => true, 'read'=> 'true', 'update'=>'true', 'delete'=> 'true'] ,
            'events'=> ['create' => true, 'read'=> 'true', 'update'=>'true', 'delete'=> 'true'],
            'tasks'=> ['create' => true, 'read'=> 'true', 'update'=>'true', 'delete'=> 'true']
            ] ] );
            Role::create(['name'=>'staff',
            'permissions' => [
                'posts'=> ['create' => true, 'read'=> 'true', 'update'=>'true', 'delete'=> 'true'] ,
                'roles'=> ['create' => false, 'read'=> false, 'update'=>false, 'delete'=> false] ,
                'users'=> ['create' => false, 'read'=> false, 'update'=>false, 'delete'=> false] ,
                'events'=> ['create' => false, 'read'=> 'true', 'update'=>'false', 'delete'=> 'false'],
                'taks'=> ['create' => false, 'read'=> 'true', 'update'=>'true', 'delete'=> 'false'],
            ] ] );
            Role::create(['name'=>'user',
            'permissions' => [
                'posts'=> ['create' => false, 'read'=> false, 'update'=>false, 'delete'=> false] ,
                'roles'=> ['create' => false, 'read'=> false, 'update'=>false, 'delete'=> false] ,
                'users'=> ['create' => false, 'read'=> false, 'update'=>false, 'delete'=> false] ,
                'events'=> ['create' => false, 'read'=> false, 'update'=>'false', 'delete'=> false],
                'tasks'=> ['create' => false, 'read'=> false, 'update'=>'false', 'delete'=> false],
            ] ] );
    }
}

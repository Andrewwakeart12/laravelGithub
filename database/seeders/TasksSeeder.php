<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->delete();
        Task::create([
            'event_name' => 'Event 1'
            ,'event_description' => 'Testing Event 1',
            'user_id'=> 2
            , 'event_start'=>Carbon::now(),
            'event_end' => new Carbon('tomorrow')
        ]);

        Task::create([
            'event_name' => 'Event 2'
            ,'event_description' => 'Testing Event 2'
            ,'user_id'=> 1
            , 'event_start'=>Carbon::now(),
            'event_end' => new Carbon('tomorrow')
        ]);
         Task::create([
            'event_name' => 'Event 3'
            ,'event_description' => 'Testing Event 3'
            ,'user_id'=> 1
            , 'event_start'=>Carbon::now(),
            'event_end' => Carbon::now()
        ]);
        Task::create([
            'event_name' => 'Event 4'
            ,'event_description' => 'Testing Event 4'
            ,'user_id'=> 1
            , 'event_start'=>Carbon::now(),
            'event_end' => new Carbon('tomorrow')
        ]);
        //
    }
}

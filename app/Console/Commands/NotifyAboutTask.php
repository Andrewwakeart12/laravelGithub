<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Task;
use App\Notifications\TaskNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Carbon;
class NotifyAboutTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:notifyUsersAboutTasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'for schedule notifications';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $usersHasTask= [];
        $tasks = Task::whereNotNull('user_id')->get();
        foreach($tasks as $task){
            $diffInDays = $task->event_start= $task->event_start->diff(Carbon::now())->days;

            array_push($usersHasTask, $task->user);
        }

        Notification::send($usersHasTask, new TaskNotification($tasks));
    }
}

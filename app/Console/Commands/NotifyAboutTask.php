<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Task;
use App\Notifications\TaskNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
class NotifyAboutTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:notifyUsersAboutTasks';

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
        $users = User::whereNotNull(['role_id'])->get()->all();
        $Admins= [];
        foreach ( $users as $user){
            if($user->isAdmin()){
                if($user->tasks->all()){
                array_push($Admins, $user);
                }
            }
        }

  /*      foreach($Admins as $user){
            $counter = 0 ;
                if($user->notifications->isEmpty())
                {
                    foreach($user->tasks as $task)
                    {
                    Notification::send($user, new TaskNotification($task));
                    }
                }else
                {
                    $i = 0;
                    $existTask = false;
                    while($existTask == false && $counter <= $user->notifications->count() - 1)
                    {
                        $notificationExist = false;
                        while($notificationExist == false && $i <= $user->tasks->count() - 1)
                            {
                                if($user->notifications[$counter]->data['id'] == $user->tasks[$i]->id)
                                {
                                    $existTask = true;
                                    $notificationExist = true;
                                }

                                $i++;
                            }

                            if($existTask == false && $notificationExist == false)
                            {
                                        Notification::send($user, new TaskNotification($user->tasks[$i]));
                            }

                            $counter++;
                    }

                }





    }
  */
    foreach($Admins as $user){

        foreach($user->tasks as $task){
            $taskInNotifications = DB::table('notifications')->where('data->id', $task->id)->get();
            if($taskInNotifications->isEmpty()){
                Notification::send($user, new TaskNotification($task));
            }else{

                $lastNotification = json_decode($taskInNotifications->first()->data);
                    if($task->event_end != null){
                        $deadline = $task->event_end->diff(Carbon::now())->days;
                    }else{
                        $deadline = $task->event_start->diff(Carbon::now())->days;
                    }
                    if( $deadline != $lastNotification->daysLeft ){
                        Notification::send($user, new TaskNotification($task));
                    }
                    else{
                        print('deadline : ' . $deadline . ' es diferente de : ' . $lastNotification->deadline);
                    }

            }

        }
        }
    }
}

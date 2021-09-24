<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use SebastianBergmann\Environment\Console;

class TaskNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
       public function __construct($task_inf)
    {
        $this->task = $task_inf;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toBroadcast($notifiable)
    {
            if($this->task->event_end != null)
            {
                $deadline = $this->task->event_end->diff(Carbon::now())->days;

              return      ['title' => $this->task->event_name,
                    'date'=>Carbon::now()->format('Y M/d '),
                    'deadline' => "You have $deadline Days before the deadline",
                'id'=> $this->task->id, 'type'=>'task', 'daysLeft' =>  $this->task->event_end->diff(Carbon::now())->days,
            ];
            }else
                {
                    $deadline = $this->task->event_start->diff(Carbon::now())->days;

                    return    ['title' => $this->task->event_name,
                    'deadline' => "You have $deadline Days before the event start",
                    'date'=>Carbon::now()->format('Y M/d '),
                    'id'=> $this->task->id, 'type'=>'task','daysLeft' =>  $this->task->event_start->diff(Carbon::now())->days];
                }

    }
    public function toArray($notifiable)
    {

        if($this->task->event_end != null)
        {
            $deadline = $this->task->event_end->diff(Carbon::now())->days;

          return      ['title' => $this->task->event_name,
                'date'=>Carbon::now()->format('Y M/d '),
                'deadline' => "You have $deadline Days before the deadline",
            'id'=> $this->task->id, 'type'=>'task', 'daysLeft' =>  $this->task->event_end->diff(Carbon::now())->days,
        ];
        }else
            {
                $deadline = $this->task->event_start->diff(Carbon::now())->days;

                return    ['title' => $this->task->event_name,
                'deadline' => "You have $deadline Days before the event start",
                'date'=>Carbon::now()->format('Y M/d '),
                'id'=> $this->task->id, 'type'=>'task','daysLeft' =>  $this->task->event_start->diff(Carbon::now())->days];
            }




        }

}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;
use App\Events\MessageSend;
class MessageSended extends Notification
{
    use Queueable;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
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


 public function toDatabase($notifiable){
    return [
        'type'=> 'messageCenter',
        'messageContent' => $this->message->text,
        'from_id'=> $this->message->user_id,
        'from'=> $this->message->username,
        'forUser_id' => $this->message->forUserId
        ,'channelId' => $this->message->channelId
    ];
 }
 public function toBroadcast($notifiable){
    return [
        'type'=> 'messageCenter',
        'messageContent' => $this->message->text,
        'from_id'=> $this->message->user_id,
        'from'=> $this->message->username,
        'firstName' => $this->message->firstName,
        'lastName' => $this->message->lastName,
        'forUser_id' => $this->message->forUserId,
        'isRead'=> null,
        'userPhoto' => User::find($this->message->user_id)->getPhotoFileDir()
        ,'channelId' => $this->message->channelId
    ];
 }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */

    public function toArray($notifiable)
    {
        return [
            'type'=> 'messageCenter',
            'messageContent' => $this->message->text,
            'from_id'=> $this->message->user_id,
            'from'=> $this->message->username,
            'firstName' => $this->message->firstName,
            'lastName' => $this->message->lastName,
            'forUser_id' => $this->message->forUserId,
            'isRead'=> null,
            'userPhoto' => User::find($this->message->user_id)->getPhotoFileDir(),
            'channelId' => $this->message->channelId
        ];
    }
}

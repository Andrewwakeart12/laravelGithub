<?php

namespace App\Notifications;

use App\Models\GroupConversations;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;
class GroupMessageSended extends Notification
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
        'type'=> 'GroupMessageCenter',
        'messageContent' => $this->message->text,
        'from_id'=> $this->message->user_id,
        'from'=> $this->message->username,
        'group_id' => $this->message->group_id
    ];
 }
 public function toBroadcast($notifiable){
    return [
        'type'=> 'GroupMessageCenter',
        'messageContent' => $this->message->text,
        'user_id'=> $this->message->user_id,
        'from_id'=> $this->message->user_id,
        'from'=> $this->message->username,
        'firstName' => $this->message->firstName,
        'lastName' => $this->message->lastName,
        'group_id' => $this->message->group_id,
        'isRead'=> null,
        'groupPhoto' => GroupConversations::find($this->message->group_id)->getPhotoFileDir(),
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
            'type'=> 'GroupMessageCenter',
            'messageContent' => $this->message->text,
            'from_id'=> $this->message->user_id,
            'from'=> $this->message->username,
            'firstName' => $this->message->firstName,
            'lastName' => $this->message->lastName,
            'group_id' => $this->message->group_id,
            'isRead'=> null,
            'groupPhoto' => GroupConversations::find($this->message->group_id)->getPhotoFileDir(),
        ];
    }
}

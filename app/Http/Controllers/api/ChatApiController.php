<?php

namespace App\Http\Controllers\api;

use App\Events\MessageSend;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Message;
use App\Notifications\MessageSended;
use Illuminate\Support\Facades\Notification;

class ChatApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsersChats(Request $request){

        $isAdmin = DB::table('roles')->where('permissions->especials->isAdmin',"true")->get("id");
        $thisUserId = $request['thisUserId'];
        $admins=User::where(['role_id'=> $isAdmin[0]->id])->orWhere(['role_id'=> $isAdmin[1]->id])->get(['id', 'username', 'firstName', 'lastName','photo_id'])->all();
        foreach($admins as $user){
            $user['profilePhoto'] = $user->getPhotoFileDir();
            if($user->id != $thisUserId){
               $user['channelId'] = $user->getChannel($thisUserId,$user->id);


            }
        }
        return $admins;
    }

public function sendMessage(Request $request){
    $message = $request['message'];
    $conversationId = $request['conversationId'];
    $from = $request['thisUserId'];
    $to = User::find($request['toUser']);

    if(trim($message != '')){

        try {
            if(DB::table('conversations')->where('id',  $conversationId)->get()->isEmpty() == false){
                $newMessage = Message::create(['text'=> $message ,
                'conversation_id'=> $conversationId,
                'user_id'=> $from ,
                'conversation_type'=>'conversation',
                ]);
                $newMessage['username']=User::find($request['thisUserId'])->username;
                $newMessage['forUserId'] = $to->id;
                $lastNotification= DB::table('notifications')->where('notifiable_id',$to->id)->where('data->type','messageCenter')->get();

                if($lastNotification->isEmpty()){
                    Notification::send($to, new MessageSended($newMessage));
                }else{
                    $DbNoficationsFromMessage =DB::table('notifications')->where('notifiable_id',$to->id)->where('data->type','messageCenter')->where('data->from_id',$from);
                    if($DbNoficationsFromMessage->get()->isEmpty()){
                    Notification::send($to, new MessageSended($newMessage));

                    }else{
                        $DbNoficationsFromMessage->delete();
                    Notification::send($to, new MessageSended($newMessage));

                    }


                }
                return response()->json($newMessage);
        }else{
            return response()->json(['error' => 'conversation Does Not exist']);

        }
        } catch (\Throwable $th) {
            return $th;
        }
        }else{
            return response()->json(['emptyMesssage' => true]);
        }


}

public function getChannels(Request $request){
        $thisUserId = $request['thisUserId'];
        $otherUserId = $request['otherUserId'];
        $firstPossiblyRelation = DB::table('conversations')->where(['first_user_id'=>$thisUserId, 'second_user_id'=> $otherUserId])->get();
        $secondPossiblyRelation = DB::table('conversations')->where(['first_user_id'=> $otherUserId, 'second_user_id'=> $thisUserId])->get();

        //DB::table('conversations')->where(['first_user_id'=>1, 'second_user_id'=> 2])->get()
        if($firstPossiblyRelation->isEmpty() != true){
            return $firstPossiblyRelation[0]->id;
        }else if($secondPossiblyRelation->isEmpty() != true){
            return $secondPossiblyRelation[0]->id;
        }else{
            $newChat = Conversation::create(['first_user_id'=> $thisUserId , 'second_user_id'=> $otherUserId]);
            return response()->json($newChat);
        }
}
public function getMessagesInChat(Request $request){
    $conversationId = $request['conversationId'];
    try {
        $messagesInConversation = Message::where('conversation_id', $conversationId)->oldest()->get();
        return $messagesInConversation;
    } catch (\Throwable $th) {
        return $th;
    }
}
}





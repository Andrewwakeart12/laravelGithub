<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\MessageSend;
use Illuminate\Support\Facades\Auth;
use App\Models\Conversation;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Message;
use App\Notifications\MessageSended;
use Illuminate\Support\Facades\Notification;
use App\Models\GroupConversations;
use App\Models\Photo;
use App\Models\GroupUser;
use App\Notifications\GroupMessageSended;

class GroupChatApiController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsersGroupChats(Request $request){

        $isAdmin = DB::table('roles')->where('permissions->especials->isAdmin',"true")->get("id");
        $thisUserId = $request['thisUserId'];
        $admins=User::where(['role_id'=> $isAdmin[0]->id])->orWhere(['role_id'=> $isAdmin[1]->id])->get(['id', 'username', 'firstName', 'lastName','photo_id'])->all();
        $groups = [];
        foreach($admins as $user){
            $user['profilePhoto'] = $user->getPhotoFileDir();
            if($user->id != $thisUserId){
               $user['channelId'] = $user->getChannel($thisUserId,$user->id);
            }else if($user->id == $thisUserId){

                if(!$user->groups->isEmpty())
                {
                $groups = $user->groups;
                    foreach ($groups as $group) {
                        $group['channelId'] = $group->pivot->group_conversations_id;
                    }
                }
            }
        }
        return response()->json(['admins'=>$admins, 'groups' => [$groups]]);
    }

public function sendGroupMessage(Request $request){
    $message = $request['message'];
    $groupId = $request['group_id'];
    $from = $request['thisUserId'];

    if(trim($message != '')){

        try {
            if(DB::table('group_conversations')->where('id',  $groupId)->get()->isEmpty() == false){
                $newMessage = Message::create(['text'=> $message ,
                'group_conversations_id'=> $groupId,
                'user_id'=> $from ,
                'conversation_type'=>'group',
                ]);
                $tempUser=User::find($request['thisUserId']);
                $newMessage['username']=$tempUser->username;
                $newMessage['firstName']=$tempUser->firstName;
                $newMessage['lastName']=$tempUser->lastName;
                $newMessage['group_id']=$groupId;


                $groupUsers = GroupUser::find($groupId)->getUsersInGroup;
                foreach ($groupUsers as $to) {
                    if($to->id != $from){

                    $lastNotification= DB::table('notifications')->where('notifiable_id',$to->id)->where('data->type','GroupMessageCenter')->get();

                    if($lastNotification->isEmpty()){
                        Notification::send($to, new GroupMessageSended($newMessage));
                    }else{
                        $DbNoficationsFromMessage =DB::table('notifications')->where('notifiable_id',$to->id)->where('data->type','GroupMessageCenter')->where('data->from_id',$from);
                        if($DbNoficationsFromMessage->get()->isEmpty()){
                        Notification::send($to, new GroupMessageSended($newMessage));

                        }else{
                            $DbNoficationsFromMessage->delete();
                        Notification::send($to, new GroupMessageSended($newMessage));

                        }


                    }
                    }
                }
                return Message::find($newMessage['id']);
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

public function getMessagesInChat(Request $request){
    $conversationId = $request['conversationId'];
    try {
        $messagesInConversation = Message::where('conversation_id', $conversationId)->oldest()->get();
        return $messagesInConversation;
    } catch (\Throwable $th) {
        return $th;
    }
}
public function createGroupChat(Request $request){

    $thisUserId = $request['thisUserId'];
    $groupName = $request['groupName'];
    $groupPhoto = $request['group_photo_id'];
    $newUsers = json_decode($request->newUsers);
    try {
        if( $file = $request->file('group_photo_id'))
        {

            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $photo = Photo::create(['file'=>$name]);

            $groupPhoto = $photo->id;
        }else{
            return response()->json(['error' => 'The photo is required']);
        }
        $newGroup=GroupConversations::create(['group_photo_id'=> $groupPhoto,'name'=> $groupName]);
        foreach ($newUsers as $user) {
            GroupUser::create(['group_conversations_id'=> $newGroup->id, 'user_id'=>$user->id]);
        }
        GroupUser::create(['group_conversations_id' => $newGroup->id, 'user_id' => $thisUserId]);

    } catch (\Throwable $th) {
        return $th;
    }
    return response()->json(['success'=> 'the group has been created']);
}

public function getAvaibleUsersForGroups(Request $request){
    $thisUserId = $request['thisUserId'];
    $isAdmin = DB::table('roles')->where('permissions->especials->isAdmin',"true")->get("id");
    $admins=User::where(['role_id'=> $isAdmin[0]->id])->orWhere(['role_id'=> $isAdmin[1]->id])->get(['id', 'username', 'firstName', 'lastName','photo_id'])->all();
    $avaibleUsers= [];
    foreach($admins as $user){
        if($user->id != $thisUserId){
            $user['profilePhoto'] = $user->getPhotoFileDir();
            array_push($avaibleUsers, $user);
        }
    }
    return $avaibleUsers;
}
public function getUsersInGroup(Request $request){
    $groupConversationId = $request['groupConversationId'];
    $users = GroupUser::find($groupConversationId)->getUsersInGroup;
    foreach ($users as $user) {
        $user['profilePhoto'] = $user->getPhotoFileDir();
    }
    return $users;

}
public function getMessagesInChatGroup(Request $request){
    $groupConversationId = $request['groupConversationId'];
    $groupMessages = GroupConversations::find($groupConversationId)->messages;
    return $groupMessages;

}
//getMessagesInChatGroup
public function preselectedSecondUser(Request $request){
    $conversation = Conversation::find($request['channel']);
    if($conversation->first_user_id == $request['thisUserId']){
        $user = User::find($conversation->second_user_id);
        $user['profilePhoto'] = $user->getPhotoFileDir();
        return $user;
    }else if($conversation->second_user_id == $request['thisUserId']){

        $user = User::find($conversation->first_user_id);
        $user['profilePhoto'] = $user->getPhotoFileDir();
        return $user;
    }

}
}

<?php

namespace App\Http\Controllers\api;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Message;
class ChatApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getUsersChats(){

        $isAdmin = DB::table('roles')->where('permissions->especials->isAdmin',"true")->get("id");
        $thisUserId = Auth::user()->id;
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
    $from = Auth::user();
    $conversationId = $request['conversationId'];
    if(DB::table('conversations')->where('id',  $conversationId)->get()->isEmpty() == false){
            Message::create(['text'=> $message , 'conversation_id'=> $conversationId,'user_id'=> $from->id , 'conversation_type'=>'conversation']);

    }else{
        return response()->json(['data' => 'conversation Does Not exist']);

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
}




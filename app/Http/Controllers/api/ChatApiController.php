<?php

namespace App\Http\Controllers\api;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
        json_decode($isAdmin);
        $admins= [];
        foreach($isAdmin as $role_id){
            $user = User::where(['role_id'=> $role_id->id])->get(['id', 'username', 'firstName', 'lastName']);
            array_push($admins,$user);

        }
        return $admins;
    }

public function sendMessage(Request $request){
    $message = $request['message'];
    $from = Auth::user();
    $conversationId = $request['conversationId'];
    if(DB::table('conversations')->where('id',  $conversationId)->get()->isEmpty() == false){
        return response()->json(['data' => 'conversation Does exist']);
    }else{
        return response()->json(['data' => 'conversation Does Not exist']);

    }

}

}




<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UserEditRequest;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Session;
use App\Models\Photo;
use App\Models\Comment;
use App\Models\CommentReply;
class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','id')->all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        $input = $request->all();
        if($file = $request->file('photo_id')){
        $name = time() . $file->getClientOriginalName();

        $file->move('images', $name);

        $photo = Photo::create(['file'=>$name]);

        $input['photo_id'] = $photo->id;
        $input['password'] = bcrypt($request->password);
        User::create($input);
            return redirect('/admin/users');
    }
        else{
            User::create($input);
            return redirect('/admin/users');
        }
       // User::create($request->all());
        //return $request->all();
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
        $user = User::findOrFail($id);
        $roles = Role::pluck('name','id')->all();
        return view('admin.users.edit', compact(['user', 'roles']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $input = $request->all();
        if($file = $request->file('photo_id')){

            if($user->photo && file_exists(public_path() . $user->photo->file)){
                $fileInDb= $user->photo->file;
                $user->photo()->delete();
                unlink(public_path() .$fileInDb );

            }
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file' => $name]);

            $input['photo_id'] = $photo->id;

            Comment::where(['email'=>$user->email])->update(['photo'=> $photo->file]);

        }
        if($user->email != $input['email']){
            Comment::where(['email'=>$user->email])->update(['email'=> $input['email']]);
            CommentReply::where(['email'=>$user->email])->update(['email'=> $input['email']]);
        }

        if(trim($request->password) == ''){
            $input = $request->except('password');
            if($file = $request->file('photo_id')){
                $input['photo_id'] = $photo->id;
            }


        }else{
            $input['password'] = bcrypt($input['password']);
        }

        $user->update($input);
        Comment::where(['email'=>$user->email])->update(['author'=> $user->name]);
        CommentReply::where(['email'=>$user->email])->update(['author'=> $user->name]);
        return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Session::flash('deleted_user', 'The user has been deleted');
        $user = User::findOrFail($id);
        if($user->photo && file_exists(public_path() . $user->photo->file)){
            unlink(public_path() . $user->photo->file );
        }
        $user->delete();
        return redirect('/admin/users');
    }
}

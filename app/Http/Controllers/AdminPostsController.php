<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostsCreateRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UsersRequest;
use App\Models\Category;
use App\Models\Photo;
use Illuminate\Support\Facades\Session;
class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name','id')->all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        $input= $request->all();
        $user=Auth::user();

        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;
        }
        $user->posts()->create($input);
        return redirect('/admin/posts');

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
        $post= Post::findOrFail($id);
        $categories = Category::pluck('name','id')->all();
        return view('admin.posts.edit', compact(['post','categories']));
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
        $input= $request->all();
        $post=Post::findOrFail($id);

        if($file = $request->file('photo_id')){
            if($post->photo && file_exists(public_path() . $post->photo->file)){
                unlink(public_path() . $post->photo->file );
            }
            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;
        }
        $post->update($input);
        return redirect('/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Session::flash('deleted_post', 'The post has been deleted');
        $post = Post::findOrFail($id);
        if($post->photo && file_exists(public_path() . $post->photo->file)){
            unlink(public_path() . $post->photo->file );
        }
        $post->delete();
        return redirect('/admin/posts');
    }
}

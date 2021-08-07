<?php

namespace App\Http\Controllers;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class AdminMediasController extends Controller
{
    public function index(){
        $photos = Photo::all();
        return view('admin.media.index', compact('photos'));
    }
    public function create(){
        return view('admin.media.create');
    }
    public function store(Request $request){
        $file = $request->file('file');

        $name = time() . $file->getClientOriginalName();

        $file->move('images', $name);

        Photo::create(['file'=>$name]);
    }
    public function destroy($id){

            Session::flash('deleted_media', 'The Media file has been deleted');
            $photo = Photo::findOrFail($id);
            if($photo && file_exists(public_path() . $photo->file)){
                unlink(public_path() . $photo->file );
            }
            $photo->delete();
            return redirect(route('media.index'));

    }
}

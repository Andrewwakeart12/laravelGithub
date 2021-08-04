@extends('layouts.admin')
@section('content')
    <h1>Edit Post</h1>
    @if ($post->photo)
    <div class="col-md-3">
        <img src="{{$post->photo->file}}" alt="" class="img-responsive img-rounded">
    </div>
    @endif
    <div class="col-sm-9">
    {!! Form::model($post,['method'=> 'PATCH' , 'action'=> ['App\Http\Controllers\AdminPostsController@update', $post->id], 'files' => true]) !!}
    <div class="form-group">
        {!! Form::label('title', 'title:') !!}
        {!! Form::text('title', null , ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('category_id', 'Category:') !!}
        {!! Form::select('category_id', array(''=>'options') + $categories, null ,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('body', 'Body:') !!}
        {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('photo_id', 'Profile picture:') !!}
        {!! Form::file('photo_id',['class'=>'form-control'], null) !!}
    </div>
    <div class="form-group">
      {!! Form::submit('Create User', ['class'=>'btn btn-primary','rows'=>3] ) !!}
    </div>
    {!! Form::close() !!}
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error )
                   <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
{!! Form::open(['method'=> 'DELETE', 'action' => ['App\Http\Controllers\AdminPostsController@destroy',$post->id]]) !!}
    {!! Form::submit('Delete User', ['class'=>'btn btn-danger']) !!}
{!! Form::close() !!}
@endsection

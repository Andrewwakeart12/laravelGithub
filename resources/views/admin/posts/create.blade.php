@extends('layouts.admin')
@section('content')
    <h1>Create Posts</h1>
    {!! Form::open(['method'=> 'POST','route'=> 'posts.store', 'files' => true]) !!}
    <div class="form-group">
        {!! Form::label('title', 'title:') !!}
        {!! Form::text('title', null , ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('category_id', 'Category:') !!}
        {!! Form::select('category_id', array(''=>'options', 1 => 'Dogs'), ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('body', 'Body:') !!}
        {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('photo_id', 'Profile picture:') !!}
        {!! Form::file('photo_id', null , ['class'=>'form-control']) !!}
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
@endsection

@extends('layouts.admin')
@section('content')
    <h1>Create Posts</h1>
    {!! Form::open(['method'=> 'POST','route'=> 'posts.store', 'files' => true]) !!}
    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null , ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email', 'Email:') !!}
        {!! Form::email('email', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password', 'Password:') !!}
        {!! Form::password('password', ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('is_active', 'Status:') !!}
        {!! Form::select('is_active', [''=> 'Choose options', 1 => 'active', 0 => 'not active' ], ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('photo_id', 'Profile picture:') !!}
        {!! Form::file('photo_id', null , ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::submit('Create User', ['class'=>'btn btn-primary']) !!}
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

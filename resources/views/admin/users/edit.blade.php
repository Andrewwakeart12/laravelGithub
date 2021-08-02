@extends('layouts.admin')
@section('content')
    <h1>Create Users</h1>
    @if ($user->photo)
    <div class="col-md-3">
        <img src="{{$user->photo->file}}" alt="" class="img-responsive img-rounded">
    </div>
    @endif
    <div class="col-sm-9">
        {!! Form::model($user,['method'=> 'PATCH','action'=> ['App\Http\Controllers\AdminUsersController@update', $user->id], 'files' => true]) !!}
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
            {!! Form::label('role_id', 'RoleId:') !!}
            {!! Form::select('role_id', $roles , null ,['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('is_active', 'Status:') !!}
            {!! Form::select('is_active', [1 => 'active', 0 => 'not active' ], null , ['class'=>'form-control']) !!}
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
    </div>
    {!! Form::open(['method'=> 'DELETE', 'action' => ['App\Http\Controllers\AdminUsersController@destroy',$user->id]]) !!}
    {!! Form::submit('Delete User', ['class'=>'btn btn-danger']) !!}
{!! Form::close() !!}
@endsection

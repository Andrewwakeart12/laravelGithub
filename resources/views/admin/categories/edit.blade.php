@extends('layouts.admin')

@section('content')

    <h1>Categories</h1>

        {!! Form::model($category ,['method'=>'PATCH', 'action' => ['App\Http\Controllers\AdminCategoriesController@update', $category->id]]) !!}
        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Create Category', ['class'=> 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}

    @endsection

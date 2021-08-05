@extends('layouts.admin')

@section('content')

    <h1>Categories</h1>
    @if ($categories)

    <div class="col-sm-6">
        {!! Form::open(['method'=>'POST', 'action' => 'App\Http\Controllers\AdminCategoriesController@store']) !!}
        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Create Category', ['class'=> 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>

    <table class="table col-sm-6">
        <tr>
            <thead>
                <th>id</th>
                <th>name</th>
                <th>Created date</th>

            </thead>
            </tr>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td>{{$category->created_at ? $category->created_at->diffForHumans() : 'no date'}}</td>
                <td><a href="{{route('categories.edit',$category->id)}}">Edit Category</a></td>
                <td>
                {!! Form::open(['method'=> 'DELETE', 'action' => ['App\Http\Controllers\AdminCategoriesController@destroy',$category->id]]) !!}
                    {!! Form::submit('Delete User', ['class'=>'btn btn-danger']) !!}
                {!! Form::close() !!}
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>

    @endif
    @endsection

@extends('layouts.admin')
@section('content')

<h1>Comments</h1>
<ul>
    @if (count($comments) > 0)
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>

                @foreach ($comments as $comment)
                <tr>
                <td>{{$comment->id}}</td>
                <td>{{$comment->author}}</td>
                <td>{{$comment->email}}</td>
                <td>
                @if ($comment->is_active == 1)
                {!! Form::open(['method'=>'PATCH', 'action'=> ['App\Http\Controllers\PostsCommentsController@update', $comment->id]]) !!}
                    {!! Form::hidden("is_active", 0) !!}
                    {!! Form::submit('aprove comment', ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
                @else
                {!! Form::open(['method'=>'PATCH', 'action'=> ['App\Http\Controllers\PostsCommentsController@update', $comment->id]]) !!}
                {!! Form::hidden("is_active", 1) !!}
                {!! Form::submit('unaprove comment', ['class'=>'btn btn-warning']) !!}
            {!! Form::close() !!}
            @endif
        </td>
        <td>                {!! Form::open(['method'=>'DELETE', 'action'=> ['App\Http\Controllers\PostsCommentsController@destroy', $comment->id]]) !!}
            {!! Form::hidden("is_active", 1) !!}
            {!! Form::submit('Delete comment', ['class'=>'btn btn-danger']) !!}
        {!! Form::close() !!}</td>
                <td><a href=" {{ '/post/' . $comment->post->id }}">go to post</a></td>


            </tr>
                @endforeach

        </tbody>
    </table>


    @else
    <h1 class="text-center">No comments</h1>
    @endif
</ul>
@stop

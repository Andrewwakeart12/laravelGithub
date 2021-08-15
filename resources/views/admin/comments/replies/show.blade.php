@extends('layouts.admin')
@section('content')

<h1>Comments</h1>
<ul>
    @if ($replies)
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>

                @foreach ($replies as $reply)
                <tr>
                <td>{{$reply->id}}</td>
                <td>{{$reply->author}}</td>
                <td>{{$reply->email}}</td>
                <td>
                @if ($reply->is_active == 1)
                {!! Form::open(['method'=>'PATCH', 'action'=> ['App\Http\Controllers\CommentsRepliesController@update', $reply->id]]) !!}
                    {!! Form::hidden("is_active", 0) !!}
                    {!! Form::submit('aprove comment', ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
                @else
                {!! Form::open(['method'=>'PATCH', 'action'=> ['App\Http\Controllers\CommentsRepliesController@update', $reply->id]]) !!}
                {!! Form::hidden("is_active", 1) !!}
                {!! Form::submit('unaprove comment', ['class'=>'btn btn-warning']) !!}
            {!! Form::close() !!}
            @endif
        </td>
        <td>                {!! Form::open(['method'=>'DELETE', 'action'=> ['App\Http\Controllers\CommentsRepliesController@destroy', $reply->id]]) !!}
            {!! Form::hidden("is_active", 1) !!}
            {!! Form::submit('Delete comment', ['class'=>'btn btn-danger']) !!}
        {!! Form::close() !!}</td>
                <td><a href=" {{ '/post/' . $reply->comment->post->id }}">go to post</a></td>


            </tr>
                @endforeach

        </tbody>
    </table>


    @else
    <h1 class="text-center">No comments</h1>
    @endif
</ul>
@stop

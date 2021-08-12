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

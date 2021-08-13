@extends('layouts.admin')
@section('content')
@foreach ($posts as $post)
<div class="col-md-6 rounded">
    <img class="img-responsive img-rounded col-md-6" src="{{$post->photo->file}}" alt="">
    <h4 >Author: {{$post->user->name}}</h4>
    <h1 class="flex">{{$post->title}}</h1>
    <h3>{{ $post->category->name }}</h3>
    <p>
        {{$post->body}}
    </p>
    <td><a href="{{route('posts.edit' , $post->id)}}">edit post</a></td><br>
    <td><a href="{{'/post/' . $post->id }}">view post</a></td><br>
    <td><a href="{{route('comments.show', $post->id) }}">view comments</a></td>
</div>
    @endforeach
@endsection

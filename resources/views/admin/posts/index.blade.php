@extends('layouts.admin')
@section('content')
@foreach ($posts as $post)
<div class="col-md-6 rounded">
    <img class="img-responsive rounded" src="{{$post->photo->file}}" alt="">
    <h4>Author: {{$post->user->name}}</h4>
    <h1>{{$post->title}}</h1>
    <p>
        {{$post->body}}
    </p>
</div>
    @endforeach
@endsection

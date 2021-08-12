@extends('layouts.blog-post')
@section('content')




                <!-- Blog Post -->
                <!-- Title -->
                <h1>{{$post->title}}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">{{$post->user->name}}</a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="{{$post->photo->file}}" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead">{{$post->body}}</p>
                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    {!! Form::open(['method'=> 'POST','route'=> 'comments.store', 'files' => true,'class'=>'form']) !!}

                        {!! Form::hidden('post_id', $post->id) !!}

                    <div class="form-group">
                        {!! Form::label('body', 'Body:') !!}
                        {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                      {!! Form::submit('Create User', ['class'=>'btn btn-primary','rows'=>3] ) !!}
                    </div>
                    {!! Form::close() !!}
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                @foreach ($comments as $comment)
                <div class="media">

                    <a class="pull-left" href="#">
                        @if ($comment->photo)
                        <img width="60" class="media-object" src="{{$comment->photo}}" alt="">
                        @endif
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$comment->author}}
                            <small>{{$comment->created_at->diffForHumans()}}</small>
                        </h4>
                        {{$comment->body}}
                    </div>
                </div>
                @endforeach
                <!-- Comment -->


@stop

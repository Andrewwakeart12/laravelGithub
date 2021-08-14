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
                @if (count($comments)> 0)
                @foreach ($comments as $comment)
                @if ($comment->is_active == 1)
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

                    @foreach ($comment->reply as $reply )

                    @if ($reply->is_active == 1)
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" width="60" src="{{$reply->photo}}" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">{{$reply->author}}
                                <small>{{$reply->created_at->diffForHumans()}}</small>
                            </h4>
                            {{$reply->body}}
                        </div>
                    </div>
                    @elseif($reply->is_active == 0 && $reply->email == Auth::user()->email)
                    <div class="media">
                        <div class="media-body">
                            <span>your comment is waiting for moderation</span>
                        </div>
                    </div>
                    @endif

                    @endforeach

                        {!! Form::open(['method'=> 'POST','route'=> 'reply.store', 'files' => true,'class'=>'form']) !!}

                        {!! Form::hidden('comment_id', $comment->id) !!}

                    <div class="form-group">
                        {!! Form::label('body', 'Reply:') !!}
                        {!! Form::textarea('body', null, ['class'=>'form-control','rows'=>1]) !!}
                    </div>

                    <div class="form-group">
                      {!! Form::submit('Create User', ['class'=>'btn btn-primary'] ) !!}
                    </div>
                    {!! Form::close() !!}

                    </div>
                </div>


                @elseif($comment->is_active == 0 && $comment->email == Auth::user()->email)
                <div class="meda">
                    <div class="media-body">
                        <span>your comment is waiting for moderation</span>
                    </div>
                </div>
                @endif

                @endforeach
                @else
                <h3>Be the first on comment</h3>
                @endif
                <!-- Comment -->


@stop

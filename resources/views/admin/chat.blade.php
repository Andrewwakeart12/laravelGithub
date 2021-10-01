@extends('layouts.admin')

@section('content')
@csrf
<div id="container">
    <chat-room :conversation="{{ $conversation }}" :current-user="{{ auth()->user() }}"></chat-room>
</div>
@endsection

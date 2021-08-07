@extends('layouts.admin')

@section('content')
<h1>Upload Media</h1>


        <form action="{{route('media.store')}}" method="POST" class="dropzone">
            @csrf
        </form>
@stop

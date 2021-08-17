@extends('layouts.app')
@section('styles')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection
@section('content')
@csrf
    <div id="appComments"></div>
@stop

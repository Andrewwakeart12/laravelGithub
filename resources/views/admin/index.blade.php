@extends('layouts.admin')
@section('scripts')


@endsection
@section('content')

@csrf
<div id="appAdminPage" >
    <app api_token="{{$api_token}}"></app>
</div>

@endsection

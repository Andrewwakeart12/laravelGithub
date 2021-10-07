@extends('layouts.admin')
@section('scripts')
<script src="{{asset('js/tinymce.min.js')}}">

</script>

@endsection
@section('content')

@csrf
<div id="appAdminPage" >
    <app api_token="{{$api_token}}"></app>
</div>

@endsection

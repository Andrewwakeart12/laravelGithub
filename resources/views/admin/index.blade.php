@extends('layouts.admin')
@section('scripts')
<script src="{{asset('js/tinymce.min.js')}}">

</script>

@endsection
@section('content')

@csrf
<div id="appAdminPage" >
    <app api_token="{{Auth::user()->api_token}}" this_user_id="{{$thisUserId}}"></app>
</div>

@endsection

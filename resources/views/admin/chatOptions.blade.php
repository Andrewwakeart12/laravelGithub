@extends('layouts.admin')
@section('scripts')
<script src="{{asset('js/tinymce.min.js')}}">

</script>

@endsection
@section('content')

@csrf
<div id="appAdminPage" >
    <chat-options>
    </chat-options>
 </div>

@endsection

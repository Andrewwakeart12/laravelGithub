@extends('layouts.admin')
@section('scripts')
<script src="{{ asset('js/app.js') }}" defer></script>
@endsection
@section('content')

@csrf
<div id="appAdminPage" hola="HOLA">
</div>


@endsection

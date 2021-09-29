@extends('layouts.admin')

@section('content')
@csrf
{{$conversation}}
@endsection

@extends('layouts.admin')

@section('content')
@if (Session::has('deleted_user'))
    <p class="bg-danger">{{session('deleted_user')}}</p>
@endif
    <h1>Users</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Img</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Active</th>
                <th>Created</th>
                <th>Updated</th>
            </tr>
        </thead>



        <tbody>
            @if ($users)
            @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td><img height="50" src="{{$user->photo ? $user->photo->file : 'no photo'}}" alt=""></td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    @if ($user->role)
                    <td>{{$user->role->name}}</td>
                    @else
                    <td>no assigned</td>
                    @endif

                    <td>{{$user->is_active== 1 ? 'Active' : 'Not Active'}}</td>
                    <td>{{$user->created_at->diffForHumans()}}</td>
                    <td>{{$user->updated_at->diffForHumans()}}</td>
                    <td><a href="{{route('users.edit' , $user->id)}}">edit user</a></td>
                </tr>
            @endforeach
            @endif
        </tbody>

    </table>
@endsection

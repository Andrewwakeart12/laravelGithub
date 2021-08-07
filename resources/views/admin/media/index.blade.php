@extends('layouts.admin')

@section('content');
<h1>Media</h1>
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Created</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($photos as $photo)
                <tr>
                    <td>{{$photo->id}}</td>
                    @if (file_exists(public_path() . $photo->file) )
                    <td><img width="60" class=" img-responsive" src="{{$photo->file}}" alt=""></td>
                    @else
                    <td>El archivo no existe en el directorio

                    </td>
                    @endif
                    <td>{{$photo->created_at ? $photo->created_at : 'no date'}}</td>
                    <td>{{$photo->file}}</td>
                    <td>
                        <td>
                            {!! Form::open(['method'=> 'DELETE', 'action' => ['App\Http\Controllers\AdminMediasController@destroy',$photo->id]]) !!}
    {!! Form::submit('Delete Image', ['class'=>'btn btn-danger']) !!}
{!! Form::close() !!}
                        </td>
                    </td>
                </tr>
            @endforeach

    </tbody>
</table>
@stop

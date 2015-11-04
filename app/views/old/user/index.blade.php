@extends('layout.main')

@section('content')
    <table class="table table-striped table-bordered" id="mainTable">
        <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th><span class="glyphicon glyphicon-remove"></span></th>
        </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->email}}</td>
            <td>{{Form::destroy('document',$user->id)}}</td>
        </tr>
            @endforeach

        </tbody>
    </table>
    
@stop

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="float-left"><i class="fas fa-users"></i> User List</h1>
        <table class="table tabble-sm">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Undone / Done / Total</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->getCountDreams(false)}} / {{$user->getCountDreams(true)}} / {{$user->getCountDreams(false, true)}}</td>
                    <td><a href="{{route('users.edit', $user->id)}}"><span class="fas fa-pencil-alt" style="color: black"></span></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


@endsection

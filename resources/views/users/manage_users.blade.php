@extends('layouts.app')
@section('title', 'Manage Users - Online Florist')

@section('content')
<div class="content">
    <h2>Manage Users</h2>
    <div class="content-container">
        <div class="table-responsive-md">
            <table class="table">
                <thead>
                    <tr>
                        <th>Picture</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td><img src="{{ $user->profile_picture }}"></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->gender }}</td>
                        <td>{{ $user->address }}</td>
                        <td>
                            <a href="/manage-users/update/{{ $user->id }}" class="btn btn-secondary mb-2">Update</a>
                            <a href="/manage-users/delete/{{ $user->id }}" class="btn btn-primary">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
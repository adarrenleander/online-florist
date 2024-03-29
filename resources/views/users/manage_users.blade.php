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
                        <th class="align-middle">Picture</th>
                        <th class="align-middle">Name</th>
                        <th class="align-middle">Email</th>
                        <th class="align-middle">Phone</th>
                        <th class="align-middle">Gender</th>
                        <th class="align-middle">Address</th>
                        <th class="align-middle">Action</th>
                    </tr>
                </thead>
                <tbody>
                <!-- iterate over each user and print in table form -->
                @foreach ($users as $user)
                    <tr>
                        <td class="align-middle"><img src="{{ $user->profile_picture }}"></td>
                        <td class="align-middle">{{ $user->name }}</td>
                        <td class="align-middle">{{ $user->email }}</td>
                        <td class="align-middle">{{ $user->phone }}</td>
                        <td class="align-middle">{{ $user->gender }}</td>
                        <td class="align-middle">{{ $user->address }}</td>
                        <td class="align-middle ">
                            <!-- go to update page to update user -->
                            <a href="/manage-users/update/{{ $user->id }}" class="btn btn-secondary mb-2">Update</a>
                            <!-- if this user is current user, then disable remove -->
                            @if (Auth::user()->id == $user->id)
                            <button class="btn btn-primary" disabled>Remove</button>
                            @else
                            <!-- else button is clickable and will act appropriately -->
                            <!-- remove the user -->
                            <a href="/manage-users/remove/{{ $user->id }}" class="btn btn-primary">Remove</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
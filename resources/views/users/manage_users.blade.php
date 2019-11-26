@extends('layout.app')
@section('title', 'Manage Users - Online Florist')

@section('content')
<div class="content">
    <h2>Manage Profile</h2>
    <div class="content-container">
        <div class="table-responsive-md">
            <table class="table table-hover">
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
            </table>
        </div>
    </div>
</div>
@endsection
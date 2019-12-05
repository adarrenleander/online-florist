@extends('layouts.app')
@section('title', 'Manage Couriers - Online Florist')

@section('content')
<div class="content">
    <h2>Manage Couriers</h2>
    <div class="content-container">
        <!-- go to insert page to insert new courier -->
        <a href="/manage-couriers/insert" class="btn btn-primary mb-4">Insert Courier</a>
        <form action="/{{ request()->path() }}" method="get" class="mb-4">
        <!-- search bar to search for couriers using keyword  -->
            <div class="form-group row">
                <input type="search" class="form-control col-md-6 py-4" name="search" placeholder="I want to find...">
                <button type="submit" class="btn btn-primary ml-3">Search</button>
            </div>
        </form>
        <div class="row">
            <!-- iterate over each courier and print in card form -->
            @foreach ($couriers as $courier)
            <div class="col-md mb-4">
                <div class="card h-100 border-primary">
                    <div class="card-body">
                        <p class="card-text">ID: {{ $courier->id }}</p>
                        <h5 class="card-title">{{ $courier->courier_name }}</h5>
                        <p class="card-text">Cost: Rp. {{ $courier->shipping_cost }}</p>
                        <div class="clearfix">
                            <!-- go to update page to update courier -->
                            <a href="/manage-couriers/update/{{ $courier->id }}" class="btn btn-secondary float-left">Update</a>
                            <!-- remove the courier -->
                            <a href="/manage-couriers/delete/{{ $courier->id }}" class="btn btn-primary float-right">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- add empty columns to make view look nice -->
            <!-- add if row doesn't consist of 5 couriers -->
            @if ($loop->last && ($loop->count % 5 != 0))
                @for ($i = 0; $i < 5 - ($loop->count % 5); $i++)
                    <div class="col-md mb-4"></div>
                @endfor
                @break
            @endif

            <!-- close this row and create a new row once 5 couriers is in one row -->
            @if ($loop->index == 4)
        </div>
        <div class="row">
            @endif
            @endforeach
        </div>
        <div>{{ $couriers->appends(request()->query())->links() }}</div>
    </div>
</div>
@endsection
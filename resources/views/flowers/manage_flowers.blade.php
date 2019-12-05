@extends('layouts.app')
@section('title', 'Manage Flowers - Online Florist')

@section('content')
<div class="content">
    <h2>Manage Flowers</h2>
    <div class="content-container">
        <!-- go to insert page to insert new flower -->
        <a href="/manage-flowers/insert" class="btn btn-primary mb-4">Insert Flower</a>
        <form action="/{{ request()->path() }}" method="get" class="mb-4">
            <!-- search bar to search for flowers using keyword  -->
            <div class="form-group row">
                <input type="search" class="form-control col-md-6 py-4" name="search" placeholder="I want to find...">
                <button type="submit" class="btn btn-primary ml-3">Search</button>
            </div>
        </form>
        <div class="row">
            <!-- iterate over each flower and print in card form -->
            @foreach ($flowers as $flower)
            <div class="col-md mb-4">
                <div class="card h-100 border-primary text-left">
                    <img src="{{ $flower->image }}" class="card-image image-fluid">
                    <div class="card-body">
                        <h5 class="card-title">{{ $flower->name }}</h5>
                        <p class="card-text">{{ $flower->description }}</p>
                        <div class="clearfix">
                            <!-- go to update page to update flower -->
                            <a href="/manage-flowers/update/{{ $flower->id }}" class="btn btn-secondary float-left">Update</a>
                            <!-- remove the flower -->
                            <a href="/manage-flowers/delete/{{ $flower->id }}" class="btn btn-primary float-right">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- add empty columns to make view look nice -->
            <!-- add if row doesn't consist of 5 flowers -->
            @if ($loop->last && ($loop->count % 5 != 0))
                @for ($i = 0; $i < 5 - ($loop->count % 5); $i++)
                    <div class="col-md mb-4"></div>
                @endfor
                @break
            @endif

            <!-- close this row and create a new row once 5 flowers is in one row -->
            @if ($loop->index == 4)
        </div>
        <div class="row">
            @endif
            @endforeach
        </div>
        <div>{{ $flowers->appends(request()->query())->links() }}</div>
    </div>
</div>
@endsection
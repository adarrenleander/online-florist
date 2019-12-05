@extends('layouts.app')
@section('title', 'Manage Flower Types - Online Florist')

@section('content')
<div class="content">
    <h2>Manage Flower Types</h2>
    <div class="content-container">
        <!-- go to insert page to insert new flower type -->
        <a href="/manage-flower-types/insert" class="btn btn-primary mb-4">Insert Flower Type</a>
        <form action="/{{ request()->path() }}" method="get" class="mb-4">
        <!-- search bar to search for flower types using keyword  -->
            <div class="form-group row">
                <input type="search" class="form-control col-md-6 py-4" name="search" placeholder="I want to find...">
                <button type="submit" class="btn btn-primary ml-3">Search</button>
            </div>
        </form>
        <div class="row">
            <!-- iterate over each flower type and print in card form -->
            @foreach ($flowerTypes as $flowerType)
            <div class="col-md mb-4">
                <div class="card h-100 border-primary">
                    <div class="card-body">
                        <h5 class="card-title">{{ $flowerType->type_name }}</h5>
                        <div class="clearfix">
                            <!-- go to update page to update flower type -->
                            <a href="/manage-flower-types/update/{{ $flowerType->id }}" class="btn btn-secondary float-left">Update</a>
                            <!-- remove the flower type -->
                            <a href="/manage-flower-types/delete/{{ $flowerType->id }}" class="btn btn-primary float-right">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- add empty columns to make view look nice -->
            <!-- add if row doesn't consist of 5 flower types -->
            @if ($loop->last && ($loop->count % 5 != 0))
                @for ($i = 0; $i < 5 - ($loop->count % 5); $i++)
                    <div class="col-md mb-4"></div>
                @endfor
                @break
            @endif

            <!-- close this row and create a new row once 5 flower types is in one row -->
            @if ($loop->index == 4)
        </div>
        <div class="row">
            @endif
            @endforeach
        </div>
        <div>{{ $flowerTypes->appends(request()->query())->links() }}</div>
    </div>
</div>
@endsection
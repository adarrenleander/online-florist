@extends('layouts.app')
@section('title', 'Catalog - Online Florist')

@section('content')
<div class="content">
    <h2>Catalog</h2>
    <div class="content-container">
        <form action="/{{ request()->path() }}" method="get" class="mb-4">
        <!-- search bar to search for flowers using keyword  -->
            <div class="form-group row">
                <input type="text" class="form-control col-md-6 py-4" name="search" placeholder="I want to buy...">
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
                            <!-- view details of flower -->
                            <a href="/flower-details/{{ $flower->id }}" class="btn btn-primary float-left">Details</a>
                            <!-- if stock is empty, disable order button -->
                            @if ($flower->stock == 0)
                            <button class="btn btn-primary float-right" disabled>Order</b>
                            @else
                            <!-- else button is clickable and will act appropriately -->
                            <!-- add flower to cart with quantity of 1 -->
                            <a href="/cart/order/{{ $flower->id }}" class="btn btn-primary float-right">Order</a>
                            @endif
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

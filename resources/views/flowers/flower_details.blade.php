@extends('layouts.app')
@section('title', 'Flower Details - Online Florist')

@section('content')
<div class="content">
    <h2>Flower Details</h2>
    <div class="content-container">
        <div class="row">
            <!-- display flower image -->
            <div class="col-md-4 border-right">
                <img src="{{ $flower->image }}" class="img-fluid">
            </div>
            <!-- display flower information -->
            <div class="col-md-8 text-left">
                <h3 class="mt-4 font-weight-bold">{{ $flower->name }}</h3>
                <p class="mb-5">{{ $flower->description }}</p>
                <form action="/cart/add/{{ $flower->id }}" method="post">
                    @csrf
                    <p>stock: {{ $flower->stock }}</p>
                    <div class="form-group row">
                        <!-- specify quantity to purchase -->
                        <input type="number" min="0" max="{{ $flower->stock }}" name="quantity" value="0" class="form-control @error('quantity') is-invalid @enderror col-md-2" @if ($flower->stock == 0) disabled @endif>
                        <h4 class="col-md-6 text-right text-primary font-weight-bold">{{ 'Rp. '.$flower->price }}</h4>
                        <!-- add to cart button to add to cart -->
                        <!-- if stock is empty, disable button so that user cannot add to cart -->
                        <button type="submit" class="btn btn-primary btn-sm ml-3" @if ($flower->stock == 0) disabled @endif>Add to cart</button>
                        <!-- error message if quantity vaildation fails -->
                        @error('quantity')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
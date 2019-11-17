@extends('layouts.app')
@section('title', ' - Online Florist')

@section('content')
<div class="content">
    <h2>Flower Details</h2>
    <div class="content-container">
        <div class="row">
            <div class="col-md-4 border-right">
                <img src="{{ $flower->image }}" class="img-fluid">
            </div>
            <div class="col-md-8 text-left">
                <h3 class="mt-4 font-weight-bold">{{ $flower->name }}</h3>
                <p class="mb-5">{{ $flower->description }}</p>
                <form action="{{ route('home') }}" method="get">
                    @csrf
                    <p>stock: {{ $flower->stock }}</p>
                    <div class="form-group row">
                        <input type="number" min="0" name="quantity" value="0" class="form-control col-md-2">
                        <h4 class="col-md-6 text-right text-primary font-weight-bold">{{ 'Rp. '.$flower->price }}</h4>
                        <button type="submit" class="btn btn-primary btn-sm ml-3">
                            {{ __('Add to cart') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
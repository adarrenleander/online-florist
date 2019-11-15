@extends('layouts.app')
@section('title', 'Catalog - Online Florist')

@section('content')
<div class="content">
    <h2>Catalog</h2>
    <div class="content-container">
        <form method="post" action="{{ url('home') }}" class="mb-4">
            @csrf
            <div class="form-group row">
                <div class="col-md-6 offset-md-3">
                    <input type="text" class="form-control" name="search">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Search') }}
                    </button>
                </div>
            </div>
        </form>
        <div class="row">
            @foreach($flowers as $flower)
            <div class="col-sm-3 mb-3">
                <div class="card h-100 border-primary text-left">
                    <img src="{{ $flower->image }}" class="card-image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $flower->name }}</h5>
                        <p class="card-text">{{ $flower->description }}</p>
                        <div class="text-center">
                            <a href="#" class="btn-card btn-primary">Details</a>
                            <a href="#" class="btn-card btn-primary">Order</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div>{{ $flowers->links() }}</div>
    </div>
</div>
@endsection

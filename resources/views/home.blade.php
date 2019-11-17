@extends('layouts.app')
@section('title', 'Catalog - Online Florist')

@section('content')
<div class="content">
    <h2>Catalog</h2>
        <div class="content-container">
        <form method="post" action="{{ route('home') }}" class="mb-4">
            @csrf
            <div class="form-group row">
                <input type="text" class="form-control col-md-6 py-4" name="search" placeholder="I want to buy...">
                <button type="submit" class="btn btn-primary ml-3">
                    {{ __('Search') }}
                </button>
            </div>
        </form>
        <div class="row">
            @foreach ($flowers as $flower)
            <div class="col-md mb-4">
                <div class="card h-100 border-primary text-left">
                    <img src="{{ $flower->image }}" class="card-image image-fluid">
                    <div class="card-body">
                        <h5 class="card-title">{{ $flower->name }}</h5>
                        <p class="card-text">{{ $flower->description }}</p>
                        <a href="#" class="btn btn-primary float-left">Details</a>
                        <a href="#" class="btn btn-primary float-right">Order</a>
                    </div>
                </div>
            </div>

            @if ($loop->last)
                @for ($i = 0; $i < 10 - $loop->count; $i++)
                    <div class="col-md mb-4"></div>
                @endfor
                @break
            @endif

            @if ($loop->index == 4)
        </div>
        <div class="row">
            @endif
            @endforeach
        </div>
        <div>{{ $flowers->links() }}</div>
    </div>
</div>
@endsection

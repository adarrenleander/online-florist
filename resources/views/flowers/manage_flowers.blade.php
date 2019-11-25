@extends('layouts.app')
@section('title', 'Manage Flowers - Online Florist')

@section('content')
<div class="content">
    <h2>Manage Flowers</h2>
    <div class="content-container">
        <a href="/manage-flowers/insert" class="btn btn-primary mb-4">Insert Flower</a>
        <form action="/{{ request()->path() }}" method="get" class="mb-4">
            <div class="form-group row">
                <input type="search" class="form-control col-md-6 py-4" name="search" placeholder="I want to find...">
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
                        <div class="clearfix">
                            <a href="/manage-flowers/update/{{ $flower->id }}" class="btn btn-secondary float-left">Update</a>
                            <a href="/manage-flowers/delete/{{ $flower->id }}" class="btn btn-primary float-right">Delete</a>
                        </div>
                    </div>
                </div>
            </div>

            @if ($loop->last && ($loop->count % 5 != 0))
                @for ($i = 0; $i < 5 - ($loop->count % 5); $i++)
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
        <div>{{ $flowers->appends(request()->query())->links() }}</div>
    </div>
</div>
@endsection
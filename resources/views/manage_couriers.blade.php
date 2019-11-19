@extends('layouts.app')
@section('title', 'Manage Couriers - Online Florist')

@section('content')
<div class="content">
    <h2>Manage Couriers</h2>
    <div class="content-container">
        <a href="/manage-couriers/insert" class="btn btn-primary mb-4">Insert Courier</a>
        <form action="/manage-couriers" method="post" class="mb-4">
            @csrf
            <div class="form-group row">
                <input type="text" class="form-control col-md-6 py-4" name="search" placeholder="I want to find...">
                <button type="submit" class="btn btn-primary ml-3">
                    {{ __('Search') }}
                </button>
            </div>
        </form>
        <div class="row">
            @foreach ($couriers as $courier)
            <div class="col-md mb-4">
                <div class="card h-100 border-primary">
                    <div class="card-body">
                        <p class="card-text">ID: {{ $courier->id }}</p>
                        <h5 class="card-title">{{ $courier->courier_name }}</h5>
                        <p class="card-text">Cost: Rp. {{ $courier->shipping_cost }}</p>
                        <div class="clearfix">
                            <a href="/manage-couriers/update/{{ $courier->id }}" class="btn btn-secondary float-left">Update</a>
                            <a href="/manage-couriers/delete/{{ $courier->id }}" class="btn btn-primary float-right">Delete</a>
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
        <div>{{ $couriers->links() }}</div>
    </div>
</div>
@endsection
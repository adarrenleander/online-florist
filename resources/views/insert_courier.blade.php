@extends('layouts.app')
@section('title', 'Insert Courier - Online Florist')

@section('content')
<div class="content">
    <h2>Insert Courier</h2>
    <div class="content-container">
        <form action="/manage-couriers/insert" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label for="courier-name" class="col-md-4 col-form-label text-md-right">{{ __('Courier Name') }}</label>
                <div class="col-md-6">
                    <input id="courier-name" type="text" class="form-control @error('courier_name') is-invalid @enderror" name="courier_name" value="{{ old('courier_name') }}" autocomplete="none" autofocus>
                    @error('courier_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="shipping-cost" class="col-md-4 col-form-label text-md-right">{{ __('Shipping Cost') }}</label>
                <div class="col-md-6">
                    <input id="shippig-cost" type="number" class="form-control @error('shipping_cost') is-invalid @enderror" name="shipping_cost" value="{{ old('shipping_cost') }}" autocomplete="none" min="0">
                    @error('shipping_cost')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-3">
                <div class="col-md-8 offset-md-2">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Insert') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
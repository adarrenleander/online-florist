@extends('layouts.app')
@section('title', 'Cart - Online Florist')

@php
    $totalPrice = 0
@endphp

@section('content')
<div class="content">
    <h2>Cart</h2>
    <div class="content-container">
        <div class="table-responsive-md">
            <table class="table">
                <thead>
                    <tr>
                        <th class="align-middle">Picture</th>
                        <th class="align-middle">Name</th>
                        <th class="align-middle">Quantity</th>
                        <th class="align-middle">Price</th>
                        <th class="align-middle">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($carts as $cart)
                    <tr>
                        <td class="align-middle"><img src="{{ $cart->flower->image }}"></td>
                        <td class="align-middle">{{ $cart->flower->name }}</td>
                        <td class="align-middle">{{ $cart->quantity }}</td>
                        <td class="align-middle">{{ $cart->flower->price }}</td>
                        <td class="align-middle">
                            <a href="/cart/remove/{{ $cart->flower->id }}" class="btn btn-primary">Remove</a>
                        </td>
                    </tr>
                    @php
                        $totalPrice += ($cart->quantity * $cart->flower->price)
                    @endphp
                @endforeach
                </tbody>
            </table>
        </div>
        <form action="/cart/checkout" method="post">
            @csrf
            <div class="form-group row">
                <label for="courier" class="col-md-7 col-form-label text-md-right">Courier</label>
                <div class="col-md-5">
                    <select id="courier" class="form-control" name="courier" autocomplete="none">
                        @foreach ($couriers as $courier)
                        <option>{{ $courier->courier_name.' - '.$courier->shipping_cost }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-7 col-form-label text-md-right font-weight-bold">Total Price</label>
                <div class="col-md-5 clearfix">
                    <label class="float-md-left col-form-label text-md-left font-weight-bold">{{ 'Rp. '.$totalPrice }}</label>
                    <button type="submit" class="btn btn-success float-md-right" @if ($carts->isEmpty()) disabled @endif>Checkout</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
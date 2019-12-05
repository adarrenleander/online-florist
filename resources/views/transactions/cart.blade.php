@extends('layouts.app')
@section('title', 'Cart - Online Florist')

<!-- initialize variable used to calculate total price -->
@php
    $totalPrice = 0;
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
                <!-- iterate over each item in user's cart and print the details -->
                @foreach ($carts as $cart)
                    <tr>
                        <td class="align-middle"><img src="{{ $cart->flower->image }}"></td>
                        <td class="align-middle">{{ $cart->flower->name }}</td>
                        <td class="align-middle">{{ $cart->quantity }}</td>
                        <td class="align-middle">{{ $cart->flower->price }}</td>
                        <td class="align-middle">
                            <!-- remove the cart item -->
                            <a href="/cart/remove/{{ $cart->flower->id }}" class="btn btn-primary">Remove</a>
                        </td>
                    </tr>
                    <!-- add price*quantity of flower to total price -->
                    @php
                        $totalPrice += ($cart->quantity * $cart->flower->price);
                    @endphp
                @endforeach
                </tbody>
            </table>
        </div>
        <form action="/cart/checkout" method="post">
            @csrf
            <!-- courier selection -->
            <div class="form-group row">
                <label for="courier" class="col-md-7 col-form-label text-md-right">Courier</label>
                <div class="col-md-5">
                    <select id="courier" class="form-control" name="courier" autocomplete="none">
                        <!-- iterate over each courier and print its details as options -->
                        @foreach ($couriers as $courier)
                        <option>{{ $courier->courier_name.' - '.$courier->shipping_cost }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-7 col-form-label text-md-right font-weight-bold">Total Price</label>
                <div class="col-md-5 clearfix">
                    <!-- display the calculated total price -->
                    <label class="float-md-left col-form-label text-md-left font-weight-bold">{{ 'Rp. '.$totalPrice }}</label>
                    <!-- checkout items in the cart -->
                    <!-- if cart is empty, disable checkout -->
                    <button type="submit" class="btn btn-success float-md-right" @if ($carts->isEmpty()) disabled @endif>Checkout</button>
                </div>
                <!-- if there was an item in the cart that became out of stock, -->
                <!-- will be automatically deleted and notification will appear -->
                @if ($outOfStock)
                <p class="col-md-12 text-md-right text-danger font-weight-bold mt-3">Some items were out of stock and removed from your cart.</p>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection
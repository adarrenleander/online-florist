@extends('layouts.app')
@section('title', 'Transaction Histroy - Online Florist')

@section('content')
<div class="content">
    <h2>Transaction History</h2>
    <div class="content-container">
        <!-- iterate over each header transaction and print the relevant details -->
        @foreach ($transactions as $transaction)
        <!-- initialize variable for calculating total price -->
        @php
            $totalPrice = 0;
        @endphp
        <div class="mb-5">
            <div class="text-left">
                <p class="my-0">Transaction ID: {{ $transaction->id }}</p>
                <p class="my-0">Transaction Date: {{ $transaction->transaction_date }}</p>
                <p class="my-0">Member Name: {{ $transaction->user->name }}</p> <!-- get the user's name from user associated with this transaction -->
                <p class="my-0">Courier: {{ $transaction->courier->courier_name }}</p> <!-- get the courier name from courier associated with this transaction -->
            </div>
            <div class="table-responsive-md">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="align-middle">Picture</th>
                            <th class="align-middle">Name</th>
                            <th class="align-middle">Quantity</th>
                            <th class="align-middle">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                    <!-- iterate over each detail transaction -->
                    @foreach ($details as $detail)
                        <!-- if detail transaction is this header transaction's, print the details -->
                        @if ($detail->headerTransaction->id == $transaction->id)
                        <tr>
                            <td class="align-middle"><img src="{{ $detail->flower->image }}"></td>
                            <td class="align-middle">{{ $detail->flower->name }}</td>
                            <td class="align-middle">{{ $detail->quantity }}</td>
                            <td class="align-middle">{{ $detail->flower->price }}</td>
                        </tr>
                        <!-- add quantity*price of flower to total price -->
                        @php
                            $totalPrice += ($detail->quantity * $detail->flower->price);
                        @endphp
                        @endif
                    @endforeach
                        <!-- display the calculated total price -->
                        <tr>
                            <td></td>
                            <td class="font-weight-bold">Total</td>
                            <td></td>
                            <td class="font-weight-bold">{{ 'Rp. '.$totalPrice }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
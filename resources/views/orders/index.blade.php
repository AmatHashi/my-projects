@extends('layouts.app')
@section('content')
<h1>all orders here</h1>
<div class="container mt-5">
    <h1 class="mb-4">Order Details</h1>

    {{-- @if($orderDetails->isEmpty())
        <div class="alert alert-info">No order details available.</div>
    @else --}}
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Payment Method</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $counter = 1;
                    @endphp
                    @foreach($order as $detail)
                        <tr>
                            <td>{{$counter++ }}</td>
                            <td>{{ $detail->order->customer->fname }} {{ $detail->order->customer->lname }}</td>
                            <td>{{ $detail->product->name }}</td>
                            <td>{{ $detail->qty }}</td>
                            <td>${{ number_format($detail->price, 2) }}</td>
                            <td>${{ number_format($detail->total, 2) }}</td>
                            <td>{{ $detail->order->payment_method }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    {{-- @endif --}}
</div>

<script src="h
@endsection
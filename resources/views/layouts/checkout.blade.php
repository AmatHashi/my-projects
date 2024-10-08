@extends('layouts.indexFront')
@section('layoutbody')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div class="container-fluid">
    <form action="{{route('orders.create')}}" method="POST" id="orderForm">
        @csrf 
    <div class="row px-xl-5">
       
            <div class="col-lg-6">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order Total</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom">
                    <h6 class="mb-3">Products</h6>
                      @php
                       $subtotal = 0; 
                       @endphp
                        @foreach($cartItems as $item)
                        @php
                        $rowTotal = $item->qty * $item->product->price;
                        $subtotal += $rowTotal; 
                        @endphp
                        <div class="d-flex justify-content-between">
                            <p>{{ $item->product->name }}</p>
                            <p>${{ $item->product->price }}</p>
                        </div>
                        @endforeach
                 
                </div>
                <div class="border-bottom pt-3 pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6>{{$subtotal}}</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">$5</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5>{{$subtotal}}</h5>
                    </div>
                </div>
            </div>
           </div>
           <div class="col-lg-6">
            <div class="mb-5">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Payment</span></h5>
                <div class="bg-light p-30">
                    <div class="form-group">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="payment_method"  id="zaad" value="Zaad">
                            <label class="custom-control-label" for="zaad">Zaad</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="payment_method" id="Edahab" value="Edahab">
                            <label class="custom-control-label" for="Edahab">Edahab</label>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="payment_method" id="banktransfer">
                            <label class="custom-control-label" for="banktransfer">Bank Transfer</label>
                        </div>
                    </div>
                    <button class="btn btn-block btn-primary font-weight-bold py-3" type="submit">Place Order</button>
                </div>
            </div>
        </div>
        {{-- </div> --}}
    </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#orderForm').on('submit', function(event) {
                event.preventDefault(); 
                let form = $(this);
                let formData = new FormData(this);
    
                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                       
                    },
                    error: function(xhr) {
                        let errorMessage = 'Something went wrong!';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                       
                    }
                });
            });
        });
    </script>
@endsection
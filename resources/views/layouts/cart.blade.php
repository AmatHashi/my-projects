<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @extends('layouts.indexFront')
    @section('layoutbody')

    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>

    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    @php
                    $subtotal = 0; 
                    @endphp
                    @foreach ($carts as $row )
                    @php
                    $rowTotal = $row->qty * $row->product->price;
                    $subtotal += $rowTotal; 
                    @endphp
                    <tbody class="align-middle">
                        <tr data-row-id="{{ $row->id }}" class="cart-row">
                            <td class="align-middle"><img src="{{ asset('storage/' . $row->product->image) }}" alt="" style="width: 50px;"> {{$row->product->name}}</td>
                            <td class="align-middle product-price" data-price="{{ $row->product->price }}">${{ number_format($row->product->price, 2) }}</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus" type="button">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center quantity-input" value="{{$row->qty}}" data-row-id="{{ $row->id }}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus" type="button">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle row-total">${{ number_format($rowTotal, 1) }}</td>
                            <td class="align-middle">
                                <button class="btn btn-sm btn-danger btn-delete" data-id="{{$row->id }}">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>                 
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-30" action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subtotal">${{ number_format($subtotal, 2) }}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">$5</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="total">${{ number_format($subtotal + $shipping, 2) }}</h5>
                        </div>
                        <a href="{{route('checkout')}}" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        function updateDatabase(cartId, quantity) {
        $.ajax({
            url: '{{ route('cart.update') }}',
            type: 'POST',
            data: {
                _token: csrfToken,
                cart_id: cartId,
                qty: quantity  
            },
            success: function(response) {
                if (response.success) {
                    updateCartUI(response.cartItems, response.subtotal);
                } else {
                    console.error('Failed to update cart:', response.message);
                }
            },
            error: function(xhr) {
                console.error('Failed to update cart:', xhr.responseText);
            }
        });
    }

    // Function to update the UI with new data
    function updateCartUI(cartItems, subtotal) {
        let total = 0;
        $('.cart-row').each(function() {
            const $row = $(this);
            const productId = $row.data('row-id');
            const cartItem = cartItems.find(item => item.id === productId);

            if (cartItem) {
                const price = parseFloat($row.find('.product-price').data('price'));
                const quantity = cartItem.qty;
                const rowTotal = price * quantity;
                total += rowTotal;

                $row.find('.quantity-input').val(quantity);
                $row.find('.row-total').text('$' + rowTotal.toFixed(2));
            }
        });

        $('#subtotal').text('$' + subtotal.toFixed(2));
        $('#total').text('$' + subtotal.toFixed(2));
    }

    // Handle plus button click
    $(document).on('click', '.btn-plus', function() {
        const $quantityInput = $(this).closest('.input-group').find('.quantity-input');
        const $row = $(this).closest('.cart-row');
        let quantity = parseInt($quantityInput.val(), 10);
        const cartId = $row.data('row-id');
        quantity += 0;
        $quantityInput.val(quantity);
        updateDatabase(cartId, quantity);
    });

    // Handle minus button click
    $(document).on('click', '.btn-minus', function() {
        const $quantityInput = $(this).closest('.input-group').find('.quantity-input');
        const $row = $(this).closest('.cart-row');
        let quantity = parseInt($quantityInput.val(), 10);
        const cartId = $row.data('row-id');
        if (quantity > 1) { 
            quantity -= 0;
            $quantityInput.val(quantity);
            updateDatabase(cartId, quantity);
        }
    });

    // Handle quantity input change
    $(document).on('change', '.quantity-input', function() {
        const $quantityInput = $(this);
        const $row = $(this).closest('.cart-row');
        const quantity = parseInt($quantityInput.val(), 10);
        const cartId = $row.data('row-id');
        if (quantity >= 1) { 
            updateDatabase(cartId, quantity);
        } else {
            $quantityInput.val(1); 
        }
    });
        $('.btn-delete').click(function() {
            const button = $(this);
            const id = button.data('id');
            const url = `{{ route('cart.delete', ':id') }}`.replace(':id', id);
            
            $.ajax({
                url: url,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    button.closest('tr').remove();
                    updateCartSummary();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Error deleting product:", textStatus, errorThrown);
                }
            });
        });
    });


    //me

    function updateCartUI(cartItems, subtotal) {
    let shipping = 5.00; // Fixed shipping cost

    let total = 0;
    $('.cart-row').each(function() {
        const $row = $(this);
        const productId = $row.data('row-id');
        const cartItem = cartItems.find(item => item.id === productId);

        if (cartItem) {
            const price = parseFloat($row.find('.product-price').data('price'));
            const quantity = cartItem.qty;
            const rowTotal = price * quantity;
            total += rowTotal;

            $row.find('.quantity-input').val(quantity);
            $row.find('.row-total').text('$' + rowTotal.toFixed(2));
        }
    });

    // Update subtotal and total
    $('#subtotal').text('$' + subtotal.toFixed(2));

    // Add shipping cost to the total
    let grandTotal = subtotal + shipping;
    $('#total').text('$' + grandTotal.toFixed(2));
}

    </script>
</body>
</html>

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
<!-- Breadcrumb End -->


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
                @foreach ($carts as $row )
                    
                <tbody class="align-middle">
                    <tr>
                        <td class="align-middle"><img src="{{ asset('storage/' . $row->product->image) }}" alt="" style="width: 50px;"> {{$row->product->name}}</td>
                        <td class="align-middle">{{$row->product->price}}</td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-minus" >
                                    <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{$row->qty}}">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">${{ number_format($row->qty * $row->product->price) }}</td>
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
                        <h6>$150</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">$10</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5>$160</h5>
                    </div>
                    <button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
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
  $('.btn-delete').on('click', function() {
      const button = $(this);
      const id = button.data('id'); 
      let url = `{{ route('cart.delete', ':id') }}`.replace(':id', id);
      console.log(url);
      $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': csrfToken
    }
  });
      
      $.ajax({
        url: url,
        type: 'DELETE',
        success: function(response) {
          button.closest('tr').remove(); 
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.error("Error deleting product:", textStatus, errorThrown);
          console.error("Error deleting product:");
          console.error("Status Code:", jqXHR.status);
          console.error("Status Text:", textStatus);
          console.error("Error Thrown:", errorThrown);

        }
      });
    });  
});
</script>
</body>
</html>
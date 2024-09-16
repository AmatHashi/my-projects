@extends('layouts.indexFront')
@section('layoutbody')
@php
use App\Models\Category;
$categories = Category::all();
@endphp

<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-3 col-md-4">
            <!-- Filter by Category -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by Category</span></h5>
            <div class="bg-light p-4 mb-30">
                <form id="filter-form" method="GET">
                  
                    <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                        <input type="radio" class="custom-control-input" id="category-all" name="category" value="" {{ request('category') == '' ? 'checked' : '' }}>
                        <label class="custom-control-label" for="category-all">All Products</label>
                    </div>
                    @foreach ($categories as $category)
                        <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                            <input type="radio" class="custom-control-input" id="category-{{ $category->id }}" name="category" value="{{ $category->id }}" {{ request('category') == $category->id ? 'checked' : '' }}>
                            <label class="custom-control-label" for="category-{{ $category->id }}">{{ $category->name }}</label>
                        </div>
                    @endforeach
                </form>
            </div>
            
            <!-- Filter by Price -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by Price</span></h5>
            <div class="bg-light p-4 mb-30">
                <form id="price-form" method="GET">
                    <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                        <input type="radio" class="custom-control-input" id="price-all" name="price" value="">
                        <label class="custom-control-label" for="price-all">All Prices</label>
                    </div>
                    @foreach (['0-50', '50-100', '100-150', '150-200', '200-250','250-300'] as $range)
                        <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                            <input type="radio" class="custom-control-input" id="price-{{ $loop->index + 1 }}" name="price" value="{{ $range }}" {{ request('price') == $range ? 'checked' : '' }}>
                            <label class="custom-control-label" for="price-{{ $loop->index + 1 }}">{{ $range }}</label>
                        </div>
                    @endforeach
                </form>
            </div>
        </div>
        
        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3" id="product-list">
                @forelse ($product as $product)
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1 product-item">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden" style="height:250px;">
                                @php
                                $images = json_decode($product->image, true); 
                                $firstImage = !empty($images) && isset($images[0]) ? $images[0] : 'default_image.jpg';
                               @endphp
                            <img class="img-fluid w-100" src="{{ asset('storage/' . $firstImage) }}" alt="Product Image">                         
                                   <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href="{{ route('product.cart') }}"><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href="#"><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href="#"><i class="fa fa-sync-alt"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href="#"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a href="{{ route('products.show', $product->id) }}" class="h6 text-decoration-none text-truncate">{{ $product->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>${{ number_format($product->price, 2) }}</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    @for ($i = 0; $i < 5; $i++)
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    @endfor
                                    <small>(99)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p>No products found.</p>
                    </div>
                @endforelse
                <div class="col-12">
                    <nav>
                        {{-- Pagination links if needed --}}
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#filter-form input, #price-form input').on('change', function() {
        var formData = $('#filter-form').serialize() + '&' + $('#price-form').serialize();
        
        var isCategoryEmpty = !$('input[name="category"]:checked').val();
        var isPriceEmpty = !$('input[name="price"]:checked').val();

        if (isCategoryEmpty && isPriceEmpty) {
            window.location.href = "{{ route('shop') }}"; 
            return;
        }

        $.ajax({
            url: "{{ route('filter.products') }}",
            type: 'GET',
            data: formData,
            success: function(response) {
                $('#product-list').html(response.html);
            },
            error: function(xhr) {
                console.log('Error:', xhr.responseText);
            }
        });
    });
});

</script>

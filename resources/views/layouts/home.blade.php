@extends('layouts.indexFront')
@section('layoutbody')
@php
     $cards = [
            [
                'icon' => 'fa-check',
                'title' => 'Quality Product',
            ],
            [
                'icon' => 'fa-shipping-fast',
                'title' => 'Free Shipping',
            ],
            [
                'icon' => 'fa-exchange-alt',
                'title' => '14-Day Return',
                'description' => 'Easy returns within 14 days',
            ],
            [
                'icon' => 'fa-phone-volume',
                'title' => '24/7 Support',
            ],
        ];
@endphp
@php
use App\Models\Category;
$category = Category::get(); 
@endphp  
<div class="container-fluid mb-3">
    <div class="row px-xl-5">
        <div class="col-lg-12">
            <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">

                <ol class="carousel-indicators">
                    @foreach ($slide as $index => $row)
                    <li data-target="#header-carousel" data-slide-to="{{ $index }}" class="{{ $index == 1? 'active' : '' }}"></li>
                @endforeach              
              </ol>
                <div class="carousel-inner">
                    @foreach ($slide as $index => $row)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" style="height: 430px;">
                        <img class="d-block w-100 h-100" src="{{ asset('storage/' . $row->image) }}" style="object-fit: cover;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">{{ $row->title }}</h1>
                                <p class="mx-md-5 px-5 animate__animated animate__bounceIn">{{ $row->description }}</p>
                                <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="{{ route('shop') }}">Shop Now</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
        
    </div>
</div>
<!-- Carousel End -->

<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        
        @foreach ($cards as $card)
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                <h1 class="fa {{ $card['icon'] }} text-primary m-0 mr-3"></h1>
                <div>
                    <h5 class="font-weight-semi-bold m-0">{{ $card['title'] }}</h5>
                </div>
            </div>
        </div>
    @endforeach
    </div>
</div>

<!-- Categories Start -->
<div class="container-fluid pt-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Categories</span></h2>
    <div class="row px-xl-5 pb-3">
        
        
        @foreach ($category as $row)
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <a class="text-decoration-none" href="{{ route('shop', $row->id) }}">
                <div class="cat-item img-zoom d-flex align-items-center mb-4">
                    <div class="overflow-hidden" style="width: 100px; height: 100px;">
                        @if ($row->products->isNotEmpty())
                            @php
                                $productImages = json_decode($row->products->first()->image, true);
                                $firstProductImage = !empty($productImages) && isset($productImages[0]) ? $productImages[0] : 'default_image.png';
                            @endphp
                            <img class="img-fluid" src="{{ asset('storage/' . $firstProductImage) }}" alt="{{ $row->name }}">
                        @else
                            <img class="img-fluid" src="{{ asset('default_image.png') }}" alt="Default Image">
                        @endif
                    </div>
                    <div class="flex-fill pl-3">
                        <h6>{{ $row->name }}</h6>
                        <small class="text-body">{{ $row->products->count() }} Products</small>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
    
    

        
    </div>
</div>
<!-- Categories End -->

<!-- Products Start -->


<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">New Arrivals </span></h2>
    <div class="row px-xl-5">
        @foreach ($newArrivals as $row)
  
    <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
<div class="product-item bg-light mb-4">
    <div class="product-img position-relative overflow-hidden" style="height:280px">
        @php
        $images = json_decode($row->image, true); 
        $firstImage = !empty($images) && isset($images[0]) ? $images[0] : 'default_image.jpg';
       @endphp
    <img class="img-fluid w-100" src="{{ asset('storage/' . $firstImage) }}" alt="Product Image">   
         {{-- <div class="product-action">
            <a href="{{route('product.cart')}}" class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
            <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
        </div> --}}
    </div>
    <div class="text-center py-4">
        <a  href="{{route('products.show',$row->id)}}" class="h6 text-decoration-none text-truncate" href=""> {{$row->name}}</a>
        <div class="d-flex align-items-center justify-content-center mt-2">
            <h5>${{$row->price}}</h5><h6 class="text-muted ml-2"></h6>
        </div>
        <div class="d-flex align-items-center justify-content-center mb-1">
            <small class="fa fa-star text-primary mr-1"></small>
            <small class="fa fa-star text-primary mr-1"></small>
            <small class="fa fa-star text-primary mr-1"></small>
            <small class="fa fa-star text-primary mr-1"></small>
            <small class="fa fa-star text-primary mr-1"></small>
            <small>(99)</small>
        </div>
    </div>
</div>
</div>
@endforeach
    
    </div>
</div>

<!-- Products End -->





<!-- Offer Start -->
 <div class="container-fluid pt-5 pb-3">
    <div class="row px-xl-5">
        <div class="col-md-6">
            <div class="product-offer mb-30" style="height: 300px;">
                <img class="img-fluid" src="{{asset('')}}assets/img/weman.jpg" alt="">
                <div class="offer-text">
                    <h6 class="text-white text-uppercase">Save 20%</h6>
                    <h3 class="text-white mb-3">Special Offer</h3>
                    <a href="{{route('shop')}}" class="btn btn-primary">Shop Now</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="product-offer mb-30" style="height: 300px;">
                <img class="img-fluid" src="{{asset('')}}assets/img/men.jpg" alt="">
                <div class="offer-text">
                    <h6 class="text-white text-uppercase">Save 20%</h6>
                    <h3 class="text-white mb-3">Special Offer</h3>
                    <a href="{{route('shop')}}" class="btn btn-primary">Shop Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Offer End --> 

{{-- recentalty --}}
<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Most Favorite Products</span></h2>
    <div class="row px-xl-5">
        @foreach ($topFavProducts as $row)

        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden" style="height:280px">
                    @php
                    $images = json_decode($row->image, true); 
                    $firstImage = !empty($images) && isset($images[0]) ? $images[0] : 'default_image.jpg';
                   @endphp
                <img class="img-fluid w-100" src="{{ asset('storage/' . $firstImage) }}" alt="Product Image">               
                     {{-- <div class="product-action">
                        <a class="btn btn-outline-dark btn-square" href="#"><i class="fa fa-shopping-cart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                    </div> --}}
                </div>
                <div class="text-center py-4">
                    <a  href="{{route('products.show',$row->id)}}" class="h6 text-decoration-none text-truncate" href="">{{$row->name}}</a>
                    <div class="d-flex align-items-center justify-content-center mt-2">
                        <h5>${{$row->price}}</h5><h6 class="text-muted ml-2"></h6>
                    </div>
                    <div class="d-flex align-items-center justify-content-center mb-1">
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small>({{ $row->favorites_count }})</small>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        
    </div>
</div>
<!-- Products End -->


<!-- Vendor Start -->
{{-- <div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel vendor-carousel">
                <div class="bg-light p-4">
                    <img src="{{asset('')}}assets/img/vendor-1.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="{{asset('')}}assets/img/vendor-2.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="{{asset('')}}assets/img/vendor-3.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="{{asset('')}}assets/img/vendor-4.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="{{asset('')}}assets/img/vendor-5.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="{{asset('')}}assets/img/vendor-6.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="{{asset('')}}assets/img/vendor-7.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="{{asset('')}}assets/img/vendor-8.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</div> --}}
<!-- Vendor End -->


@endsection
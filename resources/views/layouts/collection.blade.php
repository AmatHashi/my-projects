@extends('layouts.indexFront')

@section('layoutbody')

@foreach ($categories as $category)
    @if ($category->products->isEmpty())
        <p>No products available in this category.</p>
    @else
        <div class="container-fluid pt-5 pb-3">
            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
                <span class="bg-secondary pr-3">{{ $category->name }} </span>
            </h2>
            <div class="row px-xl-5" id="category-{{ $category->id }}">
                @foreach ($category->products as $row)
                    <div class="col-lg-3 col-md-4 col-sm-6 pb-1 product-item">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden" style="height:280px">
                                <img class="img-fluid w-100" src="{{ asset('storage/' . $row->image) }}" alt="">
                                <div class="product-action">
                                    <a href="{{ route('product.cart') }}" class="btn btn-outline-dark btn-square">
                                        <i class="fa fa-shopping-cart"></i>
                                    </a>
                                    <a class="btn btn-outline-dark btn-square">
                                        <i class="far fa-heart"></i>
                                    </a>
                                    <a class="btn btn-outline-dark btn-square">
                                        <i class="fa fa-sync-alt"></i>
                                    </a>
                                    <a class="btn btn-outline-dark btn-square">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a href="{{ route('products.show', $row->id) }}" class="h6 text-decoration-none text-truncate">
                                    {{ $row->name }}
                                </a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>${{ $row->price }}</h5>
                                    <h6 class="text-muted ml-2">
                                        <del>$123.00</del>
                                    </h6>
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
            <button class="btn btn-primary load-more" data-category-id="{{ $category->id }}" data-next-page="2">Load More</button>
        </div>
    @endif
@endforeach

@endsection

<div class="row pb-3" id="product-list">
    @forelse ($products as $product)
        <div class="col-lg-4 col-md-6 col-sm-6 pb-1 product-item">
            <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden" style="height:250px;">
                    @php
                    $images = json_decode($product->image, true); 
                    $firstImage = !empty($images) && isset($images[0]) ? $images[0] : 'default_image.jpg';
                   @endphp
                <img class="img-fluid w-100" src="{{ asset('storage/' . $firstImage) }}" alt="Product Image">                     <div class="product-action">
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
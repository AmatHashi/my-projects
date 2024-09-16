<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>E-commerce</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <link href="img/favicon.ico" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Matemasie&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <link href="{{asset('')}}assets/lib/animate/animate.min.css" rel="stylesheet">
    <link href="{{asset('')}}assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('')}}assets/css/style.css" rel="stylesheet">
     <style>
        #search-results {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 1000;
            display: none;
            max-height: 300px;
            overflow-y: auto;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #search-results ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        #search-results li {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            cursor: pointer;
        }

        #search-results li:last-child {
            border-bottom: none;
        }

        #search-results a {
            display: block;
            text-decoration: none;
            color: #333;
            font-size: 18px;
            text-align: center;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        #search-results a:hover {
            background-color: #f8f9fa;
            color: #007bff;
        }

        .input-group {
            position: relative;
        }

        .form-control {
            border-radius: 0;
            border-color: #ddd;
        }

        .input-group-append {
            position: absolute;
            top: 0;
            right: 0;
            height: 100%;
            z-index: 1;
        }
.custom-text {
    display: flex;
    align-items: center;
    text-transform: 
}

.custom-text .text-primary {
    margin-right: -0.5rem; 
    font-size: 2rem; 
}
.custom-text .text-primary {
    margin-right: 1rem; 
}

.custom-text .text-dark {
    font-size: 2rem; 
}
.matemasie-regular {
  font-family: "Matemasie", sans-serif;
  font-weight: 400;
  font-style: normal;
}


    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row bg-secondary py-1 px-xl-5">
            {{-- <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center h-100">
                    <a class="text-body mr-3" href="">About</a>
                    <a class="text-body mr-3" href="{{route('contact')}}">Contact</a>
                    <a class="text-body mr-3" href="">Help</a>
                    <a class="text-body mr-3" href="">FAQs</a>
                </div>
            </div> --}}
            <div class="col-lg-12 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">My Account</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{route('login')}}" class="dropdown-item cursor-pointer">Sign in</a>
                            <a href="{{route('user.create')}}" class="dropdown-item cursor-pointer">Sign Up</a>
                        </div>
                    </div>
                    {{-- <div class="btn-group mx-2">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">USD</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <button class="dropdown-item" type="button">EUR</button>
                            <button class="dropdown-item" type="button">GBP</button>
                            <button class="dropdown-item" type="button">CAD</button>
                        </div>
                    </div> --}}
                    {{-- <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">EN</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <button class="dropdown-item" type="button">FR</button>
                            <button class="dropdown-item" type="button">AR</button>
                            <button class="dropdown-item" type="button">RU</button>
                        </div>
                    </div> --}}
                </div>
                <div class="d-inline-flex align-items-center d-block d-lg-none">
                    <a href="" class="btn px-0 ml-2">
                        <i class="fas fa-heart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                    </a>
                    <a href="" class="btn px-0 ml-2">
                        <i class="fas fa-shopping-cart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="" class="text-decoration-none custom-text">
                    <span class="text-primary matemasie-regular">Amal</span>
                    <span class="text-dark matemasie-regular">Shop</span>
                </a>
            </div>
            
            <div class="col-lg-4 col-6 text-left">
                <form id="search-form">
                    <div class="input-group">
                        <input type="text" id="search-input" class="form-control" placeholder="Search All products and categories">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
                <div id="search-results" class="mt-2" style="display: none;">
                    <ul id="results-list" class="list-group">
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-6 text-right">
                <p class="m-0">Customer Service</p>
                <h5 class="m-0">+012 345 6789</h5>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                    <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <div class="navbar-nav w-100">
                        {{-- <div class="nav-item dropdown dropright">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Dresses <i class="fa fa-angle-right float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute rounded-0 border-0 m-0">
                                <a href="" class="dropdown-item">Men's Dresses</a>
                                <a href="" class="dropdown-item">Women's Dresses</a>
                                <a href="" class="dropdown-item">Baby's Dresses</a>
                            </div>
                        </div> --}}
                        @php
                        use App\Models\Category;
                        $category = Category::get(); 
                       @endphp
                     @foreach ($category as $row)
                     <a href="{{route('shop',$row->id)}}" class="nav-item nav-link">
                        {{$row->name}}
                     </a>                  
                      @endforeach   
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">Multi</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{route('dashboard')}}" class="nav-item nav-link active">Home</a>
                            <a href="{{route('about')}}" class="nav-item nav-link">About</a>
                            <a href="{{route('shop')}}" class="nav-item nav-link">shop</a>
                            <a href="{{route('contact')}}" class="nav-item nav-link">Contact Us</a>
                            <div class="nav-item dropdown">
                                {{-- <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages <i class="fa fa-angle-down mt-1"></i></a>
                                <div class="dropdown-menu bg-primary rounded-0 border-0 m-0">
                                    <a href="{{route('product.cart')}}" class="dropdown-item">Shopping Cart</a>
                                    <a href="{{route('checkout')}}" class="dropdown-item">Checkout</a>
                                </div> --}}
                            </div>
                            {{-- <a href="{{route('contact')}}" class="nav-item nav-link">Contact</a> --}}
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            <a href="" class="btn px-0">
                                <i class="fas fa-heart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">0</span>
                            </a>
                            <a href="{{route('product.cart')}}" id="add-to-cart-link" class="btn px-0 ml-3" >
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span id="cart" class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">0</span>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>



    {{-- me amal --}}
    @yield('layoutbody')
    <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <h5 class="text-secondary text-uppercase mb-4">Get In Touch</h5>
                <p class="mb-4">No dolore ipsum accusam no lorem. Invidunt sed clita kasd clita et et dolor sed dolor. Rebum tempor no vero est magna amet no</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>Hargiesa</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>amal@gmail.com</p>
                <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+252 063 6789076</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Quick Shop</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="{{route('dashboard')}}"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="{{route('about')}}"><i class="fa fa-angle-right mr-2"></i>About</a>
                            <a class="text-secondary mb-2" href="{{route('shop')}}"><i class="fa fa-angle-right mr-2"></i>shop</a>
                            <a class="text-secondary" href="{{route('contact')}}"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Categories</h5>
                        <div class="d-flex flex-column justify-content-start">
                          
                              @foreach ($category as $row)
                             <a class="text-secondary mb-2" href="{{route('shop',$row->id)}}" ><i class="fa fa-angle-right mr-2"></i>{{$row->name}}
                             </a>
                              @endforeach  
                            
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Newsletter</h5>
                        <p>Duo stet tempor ipsum sit amet magna ipsum tempor est</p>
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Your Email Address">
                                <div class="input-group-append">
                                    <button class="btn btn-primary">Sign Up</button>
                                </div>
                            </div>
                        </form>
                        <h6 class="text-secondary text-uppercase mt-4 mb-3">Follow Us</h6>
                        <div class="d-flex">
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-secondary">
                    &copy; <a class="text-primary" href="#">Domain</a>. All Rights Reserved. 
                    {{-- by
                    <a class="text-primary" href="https://htmlcodex.com">HTML Codex</a>
                    <br>Distributed By: <a href="https://themewagon.com" target="_blank">ThemeWagon</a> --}}
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="{{asset('')}}assets/img/payments.png" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('')}}assets/lib/easing/easing.min.js"></script>
    <script src="{{asset('')}}assets/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="{{asset('')}}assets/mail/jqBootstrapValidation.min.js"></script>
    <script src="{{asset('')}}assets/mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="{{asset('')}}assets/js/main.js"></script>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#search-input').on('keyup', function() {
            var query = $(this).val();
            if (query.length > 2) { 
                $.ajax({
                    url: '{{ route('products.search') }}',
                    method: 'GET',
                    data: { query: query },
                    success: function(data) {
                        var results = $('#results-list');
                        var resultsContainer = $('#search-results');
                        results.empty();
                        var CategoryUrl = "{{ url('/shop') }}/";

                        if (data.length > 0) {
                            $.each(data, function(index, product) {
                                var categoryUrl = CategoryUrl + product.cat_id;
                                results.append('<li class="list-group-item" data-id="' + product.id + '" data-name="' + product.name + '" data-cat="' + product.cat_id + '"><a href="' + categoryUrl + '">' + product.name + '</a></li>');
                            });
                            resultsContainer.show();
                        } else {
                            results.append('<li class="list-group-item">No products found</li>');
                            resultsContainer.show();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error); 
                    }
                });
            } else {
                $('#search-results').hide();
            }
        });

        $('#results-list').on('click', 'li', function() {
            var productId = $(this).data('id');
            var productName = $(this).data('name');
            var categoryId = $(this).data('cat');
            var input = $('#search-input');
            
            input.val(productName);
            
           window.location.href = "{{ url('/shop') }}/" + categoryId;
        });

       $(document).click(function(e) {
            if (!$(e.target).closest('#search-form').length) {
                $('#search-results').hide();
            }
        });

        // Prevent search results from hiding when clicked
        $('#search-results').click(function(e) {
            e.stopPropagation();
        });
    });
</script>





</html>
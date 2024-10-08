<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with Meyawo landing page.">
    <meta name="author" content="Devcrud">
    <title>MyPortfolio</title>
    <link rel="stylesheet" href="{{asset('')}}asset/vendor/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Matemasie&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="{{asset ('')}}asset/css/meyawo.css">
<style>
 .matemasie-regular {
  font-family: "Matemasie", sans-serif;
  font-weight: 400;
  font-style: normal;
  }
</style>
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">
    <nav class="custom-navbar" data-spy="affix" data-offset-top="20">
        <div class="container">
            <a class="logo matemasie-regular" href="#">AMAAL</a>         
            <ul class="nav">
                <li class="item">
                    <a class="link" href="{{route('home')}}">Home</a>
                </li>
                <li class="item">
                    <a class="link" href="#about">About</a>
                </li>
                <li class="item">
                    <a class="link" href="#portfolio">Portfolio</a>
                </li>
                {{-- <li class="item">
                    <a class="link" href="#testmonial">Testmonial</a>
                </li> --}}
                {{-- <li class="item">
                    <a class="link" href="#blog">Blog</a>
                </li> --}}
                <li class="item">
                    <a class="link" href="#contact">Contact</a>
                </li>
                <li class="item ml-md-3">
                    <a href="{{route('signin')}}" class="btn btn-primary">Login</a>
                </li>
            </ul>
            <a href="javascript:void(0)" id="nav-toggle" class="hamburger hamburger--elastic">
                <div class="hamburger-box">
                  <div class="hamburger-inner"></div>
                </div>
            </a>
        </div>          
    </nav>

 {{-- changable sections --}}


 @yield('layoutsbody')

    <div class="container">
        <footer class="footer">       
            <p class="mb-0">Copyright <script>document.write(new Date().getFullYear())</script> &copy; <a href="http://www.devcrud.com">DevCRUD</a></p>
            <div class="social-links text-right m-auto ml-sm-auto">
                <a href="javascript:void(0)" class="link"><i class="fab fa-whatsapp"></i></a>
                <a href="javascript:void(0)" class="link"><i class="fab fa-facebook"></i></a>
                <a href="javascript:void(0)" class="link"><i class="fab fa-linkedin"></i></a>
 
            </div>
            
        </footer>
    </div> 
    <!-- end of page footer -->
    <!-- core  -->
    <script src="{{asset('')}}asset/vendors/jquery/jquery-3.4.1.js"></script>
    <script src="{{asset('')}}asset/vendors/bootstrap/bootstrap.bundle.js"></script>

    <!-- bootstrap 3 affix -->
	<script src="{{asset('')}}asset/vendors/bootstrap/bootstrap.affix.js"></script>

    <!-- Meyawo js -->
    <script src="{{asset('')}}asset/js/meyawo.js"></script>
    
</body>
</html>
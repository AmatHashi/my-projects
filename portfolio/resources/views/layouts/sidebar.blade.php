<!doctype html>
<html lang="en">
  <head>
  	<title>Admin panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="{{asset('')}}assets/css/style.css">
  </head>
  <body>
		
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="p-4 pt-5">
		  		<a href="" class="img logo rounded-circle mb-5" style="background-image: url('{{ asset('assets/images/amal.jpeg') }}');"></a>
	        <ul class="list-unstyled components mb-5">
	          <li class="active">
	            <a href="{{route('hero')}}"  class="dropdown-toggle">Home</a>
	           
	          </li>
	          <li>
	              <a href="{{route('about.edit')}}">About</a>
	          </li>
	          <li>
              <a href="{{route('service')}}"  class="dropdown-toggle">Service</a>
             
	          </li>
	          <li>
              <a href="{{route('project.all')}}">Projects</a>
	          </li>
	        </ul>

	        {{-- <div class="footer">
	        	<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib.com</a>
						  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
	        </div> --}}

	      </div>
    	</nav>

      <div id="content" class="p-4 p-md-5">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="btn btn-primary">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
          </div>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>         
          </div>
        </nav>

        @yield('sidebarContent')

    </div>
		</div>

    <script src="{{asset('')}}assets/js/jquery.min.js"></script>
    <script src="{{asset('')}}assets/js/popper.js"></script>
    <script src="{{asset('')}}assets/js/bootstrap.min.js"></script>
    <script src="{{asset('')}}assets/js/main.js"></script>

  </body>
</html>
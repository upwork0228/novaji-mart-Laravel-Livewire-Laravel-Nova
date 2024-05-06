<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>NOVAJI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/toastr.css')}}">
    <style>
        /* Custom styles for the ecommerce store */
        body {
            background-color: #f8f9fa; /* set background color */
        }

        .navbar {
            background-color: #b82e04; /* set primary color for the navbar */
            color: #fff;
        }

        .navbar-brand {
            color: #fff;
        }

        .navbar-brand:hover {
            color: #000;
        }

        .jumbotron {
            background-color: #000000; /* set secondary color for the jumbotron */
            color: #fff;
        }

        .product-card {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .product-card:hover {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .primary-butt{
            background-color:#FF7A41;
            color:#FFFFFF;
        }

        .danger-butt{
            display:inline-block;
            background-color:indianred;
            color:#FFFFFF;
            padding:10px 20px;
            border:none;
            border-radius: 5px;
            text-align:center;
            text-decoration:none;
        }

        /* Additional custom styles go here */
    </style>
    @livewireStyles
</head>


<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Novaji</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Jumbotron -->
<div class="jumbotron text-center">
    <h1 class="display-4">Welcome to our Ecommerce Store</h1>
    <p class="lead">Discover amazing products and enjoy a seamless shopping experience.</p>
    <a class="btn btn-primary btn-lg mb-3" href="#" role="button">Shop Now</a>
</div>

<!-- Products Section -->
<div class="container">
    @yield('content')
</div>



@livewireScripts
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
<script  src="{{asset('assets/js/toastr.js')}}"></script>
<script>
    window.livewire.on('alert', param => {
        toastr[param['type']](param['message'], param['type']);
    });
</script>
</body>
</html>

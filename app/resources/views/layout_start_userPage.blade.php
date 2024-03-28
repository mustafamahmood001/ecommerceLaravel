<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Ecommerce Homepage </title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('css/webstyles.css') }}" rel="stylesheet">

    </head>
    <body>
    @if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
       <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="/">Start E-commerce</a>
                @if((Request::is('/')))
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="/" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <hr class="dropdown-divider" />
                                </li>
                                <li><a class="dropdown-item" href="{{ route('products_listing') }}">Popular Items</a></li>
                                <li><a class="dropdown-item" href="{{ route('products_listing') }}">New Arrivals</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form action="{{ route('homes') }}" method="get" enctype="multipart/form-data">  
                    <div class="input-group" style="width: 731px; height: 48px;">  
                    <div class="form-outline" data-mdb-input-init>
                            <input id="search" type="search" name="search" class="form-control" />
                        </div>
                        <button id="search-button" type="submit" class="btn btn-outline-dark" class="searchButton">Search
                        </button>
                    </div>
                 </form>

                    
                </div>
            </div>
            @endif
            <div class="dropdown">
                @guest
                <a href="{{ route('logform') }}"><button class="btn btn-secondary " type="button">Log In</button></a>
                @else
                       <a href="{{ route('carts.index') }}">
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                        </button>
                        </a>
               
                <img src="{{ asset('storage/' . auth()->user()->photo) }}"  alt="Profile Picture" class="img-fluid rounded-circle img-thumbnail" id="userProfileShow">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="accountDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    {{auth()->user()->fname ?? 'My Account'}}@endguest
                </button>
                <ul class="dropdown-menu" aria-labelledby="accountDropdown">
                    @guest
                    <!-- Show Login and Sign Up options if the user is not logged in -->
                    <li><a class="dropdown-item" href="{{ route('logform') }}">Login</a></li>
                    @else
                    <li><a class="dropdown-item" href="{{ route('userprofile.edit', ['id' => auth()->user()->id]) }}">My Profile</a></li>
                    <li><a class="dropdown-item" href="{{ route('userPasswordview') }}">Change Password</a></li>
                    <li><a class="dropdown-item" href="{{ route('logoutRoute') }}">Log Out</a></li>
                    @endguest
                </ul>
            </div>

        </nav>
       
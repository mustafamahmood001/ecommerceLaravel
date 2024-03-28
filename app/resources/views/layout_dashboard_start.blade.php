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
        <link href="{{ asset('css/dashboardStyle.css') }}" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

   
    </head>
    <body>
    @if(session('message'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="sidebar">
        <h2>E-commerce</h2>
        <ul class="nav flex-column">
      
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('adminhome') }}">
                    <i class="fas fa-home" style='font-size:36px;color:#007bff;'></i> Home
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('userdetails')}}">
                    <i class="fa fa-users" style='font-size:36px;color:#007bff;'></i> UserList
                </a>
            </li>
           
            <li class="nav-item">
                <a class="nav-link" href="{{ route('brands.index')}}">
                    <i class="fas fa-building" style='font-size:36px;color:#007bff;'></i> Brands
                </a>
            </li>
          
            <li class="nav-item">
                <a class="nav-link" href="{{ route('products.index')}}">
                    <i class="fa fa-box" style='font-size:36px;color:#007bff;'></i> Product
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('indexOrder')}}">
                    <i class="fab fa-first-order-alt" style='font-size:36px;color:#007bff;'></i> Order
                </a>
            </li>
           
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logoutRoute') }}">
                    <i class="fas fa-sign-out-alt" style='font-size:36px;color:#007bff;'></i> Log Out
                </a>
            </li>


            <!-- Add more menu items as needed -->
        </ul>
    </div>

    <div class="main-content">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="collapse navbar-collapse" id="navbarNav" style="margin-left: 94%;">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="accountDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Admin
                </button>
                <ul class="dropdown-menu" aria-labelledby="accountDropdown" style="margin-left: 88%; margin-top:-7px;">
                    <li><a class="dropdown-item" href="{{ route('userprofile.edit', ['id' => auth()->user()->id]) }}">My Profile</a></li>
                    <li><a class="dropdown-item" href="{{ route('userPasswordview') }}">Change Password</a></li>
                    <li><a class="dropdown-item" href="{{ route('logoutRoute') }}">Log Out</a></li>
                </ul>
            </div>
        </nav>
        @if(session('message'))
      <div class="alert alert-success" id="alertMessage">
        {{ session('message') }}
    </div>
    @endif

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="{{ asset('js/dashboard.js') }}"></script>

  
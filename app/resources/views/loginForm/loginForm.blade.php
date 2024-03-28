<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Ecommerce Homepage </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    
    <link href="{{ asset('css/signupLoginformstyles.css') }}" rel="stylesheet">
</head>

<body>
    @include('layout_start_userPage')
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="Login">
        <div class="loginForm">
            <div class="form-container">
                <form action="{{ route('loginAuthenticate') }}" method="post">
                    @csrf
                    <div class="formInput">
                            <h3>LOG IN</h3>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" id="email" name="email" class="form-control" required>
                            @error('email')
            <span class="text-danger">{{ $message }}</span>
        @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="loginButton">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
                <p class="text-center">Don't have an account? <a href="{{ route('regisform') }}">Sign up here</a></p>
            </div>
        </div>
    </div>
    @include('layout_footer_userPage')

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
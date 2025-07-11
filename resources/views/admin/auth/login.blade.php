<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KMU CMS</title>

    {{-- Bootstrap 4 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">

    {{-- FontAwesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/admin/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    {{-- Optional: Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('image/favicon.png') }}">
</head>
<body>

<div class="login-container">
    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="login-logo">


    <form method="POST" action="#">
        @csrf

        {{-- Username Field --}}
        <div class="form-group">
            <div class="input-wrapper">
                <input type="text" name="user" id="user" class="form-control @error('user') is-invalid @enderror" placeholder="User" value="{{ old('user') }}" required autofocus>
                <i class="fa fa-user"></i>
            </div>
            @error('user')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Password Field --}}
        <div class="form-group">
            <div class="input-wrapper">
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                <i class="fa fa-lock"></i>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Submit Button --}}
        <button type="submit" class="btn btn-login btn-block">Login</button>
    </form>
</div>

{{-- Bootstrap Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

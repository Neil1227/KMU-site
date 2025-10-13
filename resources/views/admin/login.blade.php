<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KMU CMS</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/kmlogo.png') }}">

    {{-- Bootstrap 4 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    {{-- FontAwesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/admin/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
</head>

<body>

    <div class="login-container">
        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="login-logo">

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf

            {{-- Username --}}
            <div class="form-group">
                <div class="input-wrapper">
                    <input type="text" name="user" id="user"
                        class="form-control @error('user') is-invalid @enderror"
                        placeholder="Username"
                        value="{{ old('user') }}" required autofocus>
                    <i class="fa fa-user"></i>
                </div>

            </div>


            {{-- Password --}}
            <div class="form-group">
                <div class="input-wrapper">
                    <input type="password" name="password" id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Password" required>
                    <i class="fa fa-lock"></i>
                </div>
                @error('user')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @error('password')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <button type="submit" class="btn btn-login btn-block">Login</button>

            {{-- Optional: General errors --}}
            @if($errors->any() && !$errors->has('user') && !$errors->has('password'))
            <div class="alert alert-danger mt-2">
                {{ $errors->first() }}
            </div>
            @endif
        </form>

    </div>

    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');

            togglePassword.addEventListener('click', function() {
                const type = passwordInput.type === 'password' ? 'text' : 'password';
                passwordInput.type = type;
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        });
    </script>
</body>

</html>
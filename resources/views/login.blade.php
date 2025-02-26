<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EduTrack - LogIn</title>

    <link rel="icon" type="image/x-icon" href="/storage/favicon.ico">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/loginpage.css') }}">
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">

            <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h1>Create Account</h1>

                {{-- <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div> --}}

                <span>Use your email for registration</span>

                <input type="text" name="name" placeholder="Name" value="{{ old('name') }}">
                @error('name')
                    <span style="color: red;">{{ $message }}</span>
                @enderror

                <input type="email" name="emailr" placeholder="Email" value="{{ old('emailr') }}">
                @error('emailr')
                    <span style="color: red;">{{ $message }}</span>
                @enderror

                <input type="password" name="passwordr" placeholder="Password">
                @error('passwordr')
                    <span style="color: red;">{{ $message }}</span>
                @enderror

                <input type="password" name="passwordr_confirmation" placeholder="Confirm Password">

                <input type="file" name="image">
                @error('image')
                    <span style="color: red;">{{ $message }}</span>
                @enderror

                @if (session('success'))
                    <p style="color: green;">{{ session('success') }}</p>
                @endif

                <button type="submit">Sign Up</button>
            </form>

        </div>
        <div class="form-container sign-in">

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <h1>Sign In</h1>

                {{-- <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div> --}}

                <span>Use your email password</span>

                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                @error('email')
                    <span style="color: red;">{{ $message }}</span>
                @enderror

                <input type="password" name="password" placeholder="Password" required>
                @error('password')
                    <span style="color: red;">{{ $message }}</span>
                @enderror

                <a href="#">→ Forget Your Password? ←</a>

                @if (session('error'))
                    <p style="color: red;">{{ session('error') }}</p>
                @endif

                <button type="submit">Sign In</button>
            </form>

        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>EduTrack</h1>
                    <p>Register with your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('css/loginpage.css') }}"></script>

    <script>
        const container = document.getElementById('container');
        const registerBtn = document.getElementById('register');
        const loginBtn = document.getElementById('login');

        registerBtn.addEventListener('click', () => {
            container.classList.add("active");
        });

        loginBtn.addEventListener('click', () => {
            container.classList.remove("active");
        });
    </script>

</body>

</html>

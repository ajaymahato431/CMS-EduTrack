<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduTrack &bull; Portal Login</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/loginpage.css') }}">
    <style>
        .input-group-custom {
            position: relative;
            width: 100%;
        }
        .input-group-custom input {
            padding-right: 40px !important;
        }
        .toggle-password-btn {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none !important;
            border: none !important;
            color: #888;
            padding: 0 !important;
            margin: 0 !important;
            cursor: pointer;
            width: auto !important;
            height: auto !important;
            font-size: 14px;
        }
        .toggle-password-btn:hover {
            color: #4f46e5;
        }
        .alert-pill {
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 500;
            width: 100%;
            text-align: center;
            margin-bottom: 10px;
        }
        .alert-pill-success {
            background-color: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }
        .alert-pill-error {
            background-color: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }
        .error-hint {
            color: #ef4444;
            font-size: 11px;
            margin-top: -4px;
            margin-bottom: 6px;
            width: 100%;
            text-align: left;
        }
        body {
            min-height: 100vh;
            height: auto !important;
            padding: 24px 12px;
        }
        .portal-footer {
            margin-top: 18px;
            font-size: 13px;
            color: #475569;
            text-align: center;
        }
        .portal-footer a {
            color: #4f46e5;
            font-weight: 600;
            text-decoration: none;
        }
        .portal-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    @php
    $registrationHasError = $errors->has('name') || $errors->has('emailr') || $errors->has('passwordr') ||
    $errors->has('passwordr_confirmation') || $errors->has('image');
    @endphp

    <div class="container{{ $registrationHasError ? ' active' : '' }}" id="container">
        {{-- Register Form --}}
        <div class="form-container sign-up">
            <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h1 style="margin-bottom: 8px;">Create Account</h1>
                <span style="color: #64748b; margin-bottom: 12px;">Sign up as a new student learner</span>

                @if (session('success'))
                <div class="alert-pill alert-pill-success">{{ session('success') }}</div>
                @endif

                <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required>
                @error('name')
                <div class="error-hint">{{ $message }}</div>
                @enderror

                <input type="email" name="emailr" placeholder="Email Address" value="{{ old('emailr') }}" required>
                @error('emailr')
                <div class="error-hint">{{ $message }}</div>
                @enderror

                <div class="input-group-custom">
                    <input type="password" name="passwordr" id="reg-password" placeholder="Password (min 6 chars)" required>
                    <button type="button" class="toggle-password-btn" onclick="togglePassword('reg-password', this)">
                        <i class="fa-regular fa-eye"></i>
                    </button>
                </div>
                @error('passwordr')
                <div class="error-hint">{{ $message }}</div>
                @enderror

                <div class="input-group-custom">
                    <input type="password" name="passwordr_confirmation" id="reg-password-confirm" placeholder="Confirm Password" required>
                    <button type="button" class="toggle-password-btn" onclick="togglePassword('reg-password-confirm', this)">
                        <i class="fa-regular fa-eye"></i>
                    </button>
                </div>

                <div style="width: 100%; text-align: left; margin: 6px 0;">
                    <label style="font-size: 11px; color: #64748b;">Profile Picture (Optional)</label>
                    <input type="file" name="image" accept="image/*" style="padding: 6px; background: #f1f5f9;">
                </div>
                @error('image')
                <div class="error-hint">{{ $message }}</div>
                @enderror

                <button type="submit" style="margin-top: 14px;">Sign Up</button>
            </form>
        </div>

        {{-- Sign In Form --}}
        <div class="form-container sign-in">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <h1 style="margin-bottom: 8px;">Sign In</h1>
                <span style="color: #64748b; margin-bottom: 12px;">Access your EduTrack account</span>

                @if (session('error'))
                <div class="alert-pill alert-pill-error">{{ session('error') }}</div>
                @endif

                @if (session('success'))
                <div class="alert-pill alert-pill-success">{{ session('success') }}</div>
                @endif

                <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required autofocus>
                @error('email')
                <div class="error-hint">{{ $message }}</div>
                @enderror

                <div class="input-group-custom">
                    <input type="password" name="password" id="login-password" placeholder="Password" required>
                    <button type="button" class="toggle-password-btn" onclick="togglePassword('login-password', this)">
                        <i class="fa-regular fa-eye"></i>
                    </button>
                </div>
                @error('password')
                <div class="error-hint">{{ $message }}</div>
                @enderror

                <button type="submit" style="margin-top: 16px;">Sign In</button>
            </form>
        </div>

        {{-- Toggle Panels --}}
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Already have an account? Sign in to resume your learning and management session</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>EduTrack Portal</h1>
                    <p>Register as a new student learner or switch to create your educational profile</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <footer class="portal-footer">
        <p>Designed and Developed by <a href="https://ajaymahato9988.com.np" target="_blank" rel="noopener noreferrer">Ajay Mahato</a></p>
    </footer>

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

        function togglePassword(inputId, triggerBtn) {
            const input = document.getElementById(inputId);
            const icon = triggerBtn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>
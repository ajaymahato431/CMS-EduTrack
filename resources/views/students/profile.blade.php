<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Profile &bull; EduTrack</title>
    <meta name="description" content="EduTrack Student Profile and Enrolled Courses">

    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">

    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700|Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/student/styles-merged.css') }}">
    <link rel="stylesheet" href="{{ asset('css/student/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/student/custom.css') }}">

    <style>
        :root {
            --edu-primary: #0c5adb;
            --edu-secondary: #051937;
            --edu-accent: #fbbf24;
            --edu-muted: #f5f7fb;
            --edu-dark: #1f2937;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            color: var(--edu-dark);
            background: var(--edu-muted);
        }

        .probootstrap-header-top {
            background: linear-gradient(90deg, rgba(5, 25, 55, 0.95) 0%, rgba(12, 90, 219, 0.95) 100%);
            color: #f9fafb;
            font-size: 0.95rem;
            padding: 0.65rem 0;
        }

        .probootstrap-header-top a {
            color: inherit;
            opacity: 0.9;
            transition: opacity 0.2s ease;
        }

        .probootstrap-header-top a:hover {
            opacity: 1;
        }

        .probootstrap-top-quick-contact-info {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.75rem 1.5rem;
        }

        .probootstrap-top-social ul {
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
            padding-left: 0;
            margin: 0;
            list-style: none;
        }

        .probootstrap-navbar {
            border: 0;
            box-shadow: 0 12px 30px -20px rgba(15, 23, 42, 0.45);
            min-height: 70px;
            background: #fff;
        }

        .probootstrap-navbar .navbar-brand img {
            width: 60px;
        }

        /* Profile Hero Section */
        .profile-hero-slider {
            position: relative;
            background-size: cover;
            background-position: center;
            background-image: url('{{ asset('img/slider_2.jpg') }}');
            min-height: 380px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-hero-slider::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(120deg, rgba(5, 25, 55, 0.85) 0%, rgba(12, 90, 219, 0.75) 100%);
        }

        .profile-hero-content {
            position: relative;
            z-index: 2;
            padding: 80px 0 60px;
            color: #fff;
        }

        .profile-hero-heading {
            font-size: clamp(2.2rem, 4vw, 3.2rem);
            font-weight: 700;
            color: #fff;
            margin-bottom: 12px;
            font-family: 'Raleway', sans-serif;
        }

        /* Profile Cards & Dashboard */
        .student-profile-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 20px 50px -25px rgba(12, 90, 219, 0.25);
            border: 1px solid #e2e8f0;
            overflow: hidden;
            margin-bottom: 30px;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .student-profile-header-banner {
            height: 120px;
            background: linear-gradient(135deg, var(--edu-secondary) 0%, var(--edu-primary) 100%);
            position: relative;
        }

        .student-avatar-container {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid #ffffff;
            position: absolute;
            bottom: -60px;
            left: 50%;
            transform: translateX(-50%);
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            background: #ffffff;
        }

        .student-avatar-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .student-profile-body {
            padding: 70px 24px 28px;
            text-align: center;
        }

        .student-name {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--edu-secondary);
            margin-bottom: 4px;
            font-family: 'Raleway', sans-serif;
        }

        .student-role-badge {
            display: inline-block;
            background: #dcfce7;
            color: #15803d;
            border: 1px solid #bbf7d0;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 16px;
        }

        .student-info-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.95rem;
        }

        .student-info-item:last-child {
            border-bottom: none;
        }

        .student-info-label {
            color: #64748b;
            font-weight: 500;
        }

        .student-info-value {
            color: #1e293b;
            font-weight: 600;
        }

        /* Profile Action Buttons */
        .profile-btn-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 20px;
        }

        .profile-action-btn {
            border-radius: 50px;
            padding: 10px 20px;
            font-weight: 600;
            font-size: 0.9rem;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            text-align: center;
            display: block;
            width: 100%;
        }

        .btn-action-primary {
            background: var(--edu-primary);
            color: #fff;
        }

        .btn-action-primary:hover {
            background: #0843a8;
            color: #fff;
            transform: translateY(-2px);
        }

        .btn-action-outline {
            background: #f8fafc;
            color: var(--edu-secondary);
            border: 1px solid #cbd5e1;
        }

        .btn-action-outline:hover {
            background: #e2e8f0;
            color: var(--edu-secondary);
            transform: translateY(-2px);
        }

        /* KPI Cards in Student Dashboard */
        .student-kpi-card {
            background: #ffffff;
            border-radius: 18px;
            padding: 24px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 10px 30px -15px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            transition: transform 0.2s ease;
        }

        .student-kpi-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 40px -15px rgba(12, 90, 219, 0.15);
        }

        .kpi-title {
            font-size: 0.85rem;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .kpi-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--edu-secondary);
            line-height: 1.1;
        }

        .kpi-icon-wrap {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #eef2ff;
        }

        .kpi-icon-wrap img {
            width: 26px;
            height: 26px;
        }

        /* Enrolled Courses Card */
        .content-card-wrap {
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 10px 30px -15px rgba(0, 0, 0, 0.05);
            padding: 28px;
            margin-bottom: 30px;
        }

        .content-card-title {
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--edu-secondary);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-family: 'Raleway', sans-serif;
        }

        .fee-badge {
            background: #ecfdf5;
            color: #047857;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 6px;
            border: 1px solid #a7f3d0;
            font-size: 0.9rem;
        }

        /* Modal Styles */
        .modal-content {
            border-radius: 16px;
            border: none;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.25);
        }

        .modal-header {
            background: linear-gradient(135deg, var(--edu-secondary) 0%, var(--edu-primary) 100%);
            color: #fff;
            padding: 20px 24px;
            border-bottom: none;
        }

        .modal-header .modal-title {
            font-weight: 700;
            color: #fff;
            font-size: 1.25rem;
        }

        .modal-header .close {
            color: #fff;
            opacity: 0.85;
            text-shadow: none;
            font-size: 24px;
        }

        .modal-body {
            padding: 24px;
        }

        .modal-footer {
            padding: 16px 24px;
            border-top: 1px solid #f1f5f9;
            background: #f8fafc;
        }

        .form-control {
            border-radius: 8px;
            height: 44px;
            border-color: #cbd5e1;
            font-size: 0.95rem;
        }

        .form-control:focus {
            border-color: var(--edu-primary);
            box-shadow: 0 0 0 3px rgba(12, 90, 219, 0.15);
        }
    </style>
</head>

<body>
    <div class="probootstrap-page-wrapper">
        {{-- Header Top Bar --}}
        <div class="probootstrap-header-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-9 probootstrap-top-quick-contact-info">
                        <span><a href="https://www.google.com/maps/place/Bharatpur+44200/" style="text-decoration: none">Bharatpur, Chitwan, Nepal</a></span>
                        <span><a href="https://api.whatsapp.com/send?phone=9779855033553" style="text-decoration: none">+977 9855033553</a></span>
                        <span><a href="mailto:ajaymahato@notedinsights.com" style="text-decoration: none">ajaymahato@notedinsights.com</a></span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 probootstrap-top-social">
                        <ul>
                            <li><a href="https://www.facebook.com/harekrishna431"><img src="{{ asset('svg/facebook.svg') }}" style="width: 18px" alt="Facebook"></a></li>
                            <li><a href="https://www.instagram.com/summerlove9988/"><img src="{{ asset('svg/instagram.svg') }}" style="width: 18px" alt="Instagram"></a></li>
                            <li><a href="https://twitter.com/ajaymahato9988"><img src="{{ asset('svg/twitter.svg') }}" style="width: 18px" alt="Twitter"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Navigation Bar --}}
        <nav class="navbar navbar-default probootstrap-navbar">
            <div class="container" style="height: 70px;">
                <div class="navbar-header" style="height: 70px;">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#navbar-collapse" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/home" title="EduTrack">
                        <img src="{{ asset('img/logo.png') }}" alt="EduTrack Logo" style="width: 60px">
                    </a>
                </div>

                <div id="navbar-collapse" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="/home#home">Home</a></li>
                        <li><a href="/home#about">About</a></li>
                        <li><a href="/home#course">Courses</a></li>
                        <li><a href="/home#teachers">Teachers</a></li>
                        <li><a href="/home#testimonial">Testimonial</a></li>
                        <li><a href="/home#contact">Contact</a></li>
                        <li class="active"><a href="/profile">Profile</a></li>
                        <li>
                            <a href="/logout" style="color: #ef4444; font-weight: 600;">
                                <img src="{{ asset('svg/arrow-right.svg') }}" style="width: 12px; margin-right: 4px; filter: invert(34%) sepia(85%) saturate(3500%) hue-rotate(345deg);" alt="Logout">
                                Log Out
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        {{-- Matching Hero Section --}}
        <section class="profile-hero-slider" id="profile-hero">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 text-center profile-hero-content">
                        <h1 class="profile-hero-heading probootstrap-animate">Student Portal & Profile</h1>
                        <p class="lead probootstrap-animate" style="color: rgba(255, 255, 255, 0.9); margin-bottom: 0;">
                            Manage your personal credentials, contact details, and account security
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Main Profile & Learning Activity Section --}}
        <section class="probootstrap-section" style="padding: 60px 0;">
            <div class="container">
                {{-- Flash Notifications --}}
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade in" role="alert" style="border-radius: 12px; font-weight: 500;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Success!</strong> {{ session('success') }}
                </div>
                @endif

                @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade in" role="alert" style="border-radius: 12px; font-weight: 500;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Notice:</strong> {{ session('error') }}
                </div>
                @endif

                <div class="row">
                    {{-- Left Column: Profile Card & Actions --}}
                    <div class="col-lg-4 col-md-5">
                        <div class="student-profile-card">
                            <div class="student-profile-header-banner">
                                <div class="student-avatar-container">
                                    <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}">
                                </div>
                            </div>
                            <div class="student-profile-body">
                                <h3 class="student-name">{{ Auth::user()->name }}</h3>
                                <div>
                                    <span class="student-role-badge">
                                        {{ Auth::user()->role?->role_name ? ucfirst(Auth::user()->role->role_name) : 'Student Learner' }}
                                    </span>
                                </div>

                                <div class="student-info-list" style="margin-top: 15px;">
                                    <div class="student-info-item">
                                        <span class="student-info-label">Account ID</span>
                                        <span class="student-info-value">#{{ Auth::user()->id }}</span>
                                    </div>
                                    <div class="student-info-item">
                                        <span class="student-info-label">Email Address</span>
                                        <span class="student-info-value" style="word-break: break-all;">{{ Auth::user()->email }}</span>
                                    </div>
                                    <div class="student-info-item">
                                        <span class="student-info-label">Member Since</span>
                                        <span class="student-info-value">{{ Auth::user()->created_at ? Auth::user()->created_at->format('M Y') : 'Active' }}</span>
                                    </div>
                                </div>

                                <div class="profile-btn-group">
                                    <button class="profile-action-btn btn-action-primary" data-toggle="modal" data-target="#updateProfileModal">
                                        Update Profile Photo
                                    </button>
                                    <button class="profile-action-btn btn-action-outline" data-toggle="modal" data-target="#updateNameModal">
                                        Edit Full Name
                                    </button>
                                    <button class="profile-action-btn btn-action-outline" data-toggle="modal" data-target="#updatePasswordModal">
                                        Change Password
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right Column: Dashboard Metrics & Course Enrollments --}}
                    <div class="col-lg-8 col-md-7">
                        {{-- 3 KPI Summary Cards --}}
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="student-kpi-card">
                                    <div>
                                        <div class="kpi-title">Enrolled Courses</div>
                                        <div class="kpi-value">{{ isset($enrollments) ? $enrollments->count() : 0 }}</div>
                                    </div>
                                    <div class="kpi-icon-wrap" style="background: #eef2ff;">
                                        <img src="{{ asset('svg/bookmark.svg') }}" alt="Courses">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="student-kpi-card">
                                    <div>
                                        <div class="kpi-title">Total Fees Paid</div>
                                        <div class="kpi-value" style="font-size: 1.45rem; color: #047857;">
                                            Rs. {{ number_format($totalPaid ?? 0) }}
                                        </div>
                                    </div>
                                    <div class="kpi-icon-wrap" style="background: #ecfdf5;">
                                        <img src="{{ asset('svg/check.svg') }}" alt="Fees">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="student-kpi-card">
                                    <div>
                                        <div class="kpi-title">Account Status</div>
                                        <div class="kpi-value" style="font-size: 1.45rem; color: #0c5adb;">Active</div>
                                    </div>
                                    <div class="kpi-icon-wrap" style="background: #e0f2fe;">
                                        <img src="{{ asset('svg/clipboard.svg') }}" alt="Status">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Enrolled Courses Directory --}}
                        <div class="content-card-wrap">
                            <div class="content-card-title">
                                <span>My Enrolled Courses</span>
                                <a href="/home#course" class="btn btn-sm btn-primary" style="border-radius: 20px; font-weight: 600; padding: 6px 16px;">
                                    + Browse Courses
                                </a>
                            </div>

                            @if(isset($enrollments) && $enrollments->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead>
                                        <tr style="background: #f8fafc; font-size: 0.85rem; text-transform: uppercase; color: #64748b;">
                                            <th>Course</th>
                                            <th>Credit Hours</th>
                                            <th>Paid Fee</th>
                                            <th>Enrollment Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($enrollments as $item)
                                        <tr>
                                            <td style="font-weight: 700; color: #1e293b;">
                                                {{ $item->course->course_name ?? 'N/A' }}
                                            </td>
                                            <td>
                                                <span class="label label-default" style="font-weight: 600; padding: 4px 8px;">
                                                    {{ $item->course->credit_hours ?? 3 }} Hours
                                                </span>
                                            </td>
                                            <td>
                                                <span class="fee-badge">Rs. {{ number_format($item->paid_fee) }}</span>
                                            </td>
                                            <td style="color: #64748b; font-size: 0.9rem;">
                                                {{ $item->created_at ? $item->created_at->format('M d, Y') : 'Active' }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <div class="text-center" style="padding: 40px 20px; color: #64748b;">
                                <div style="margin-bottom: 16px;">
                                    <img src="{{ asset('svg/bookmark.svg') }}" style="width: 48px; opacity: 0.4;" alt="No courses">
                                </div>
                                <h4 style="font-weight: 700; color: #334155; margin-bottom: 8px;">No Course Enrollments Found</h4>
                                <p style="max-width: 420px; margin: 0 auto 20px;">
                                    You have not registered for any courses under this name yet. Browse our verified curriculum and enroll today.
                                </p>
                                <a href="/home#course" class="btn btn-primary" style="border-radius: 50px; padding: 10px 24px; font-weight: 600;">
                                    Explore Available Courses
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Matching Footer --}}
        <footer class="probootstrap-footer" id="contact" style="background: linear-gradient(200deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 35%, rgba(0,212,255,1) 100%);">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="probootstrap-footer-widget">
                            <h3>About EduTrack</h3>
                            <p>We're your all-in-one solution for effortless course management. Our user-friendly
                                platform streamlines organization, communication, and learning. Join us for an educational journey like no other!</p>
                            <h3>Social</h3>
                            <ul class="probootstrap-footer-social">
                                <li><a href="https://www.facebook.com/harekrishna431"><img src="{{ asset('svg/facebook.svg') }}" style="width: 18px" alt="Facebook"></a></li>
                                <li><a href="https://www.instagram.com/summerlove9988/"><img src="{{ asset('svg/instagram.svg') }}" style="width: 18px" alt="Instagram"></a></li>
                                <li><a href="https://twitter.com/ajaymahato9988"><img src="{{ asset('svg/twitter.svg') }}" style="width: 18px" alt="Twitter"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-md-push-1">
                        <div class="probootstrap-footer-widget">
                            <h3>Quick Links</h3>
                            <ul>
                                <li><a href="/home#home">Home</a></li>
                                <li><a href="/home#about">About</a></li>
                                <li><a href="/home#course">Courses</a></li>
                                <li><a href="/home#teachers">Teachers</a></li>
                                <li><a href="/profile">My Profile</a></li>
                                <li><a href="/logout">Log Out</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="probootstrap-footer-widget">
                            <h3>Contact Info</h3>
                            <ul class="probootstrap-contact-info">
                                <li><span><a href="https://www.google.com/maps/place/Bharatpur+44200/" style="text-decoration: none">Bharatpur, Chitwan, Nepal</a></span></li>
                                <li><span><a href="mailto:ajaymahato@notedinsights.com" style="text-decoration: none">ajaymahato@notedinsights.com</a></span></li>
                                <li><span><a href="https://api.whatsapp.com/send?phone=9779855033553" style="text-decoration: none">+977 9855033553</a></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="probootstrap-copyright">
                <div class="container">
                    <div class="row">
                        <div class="text-left col-md-8">
                            <p>&copy; {{ now()->year }} <a href="https://notedinsights.com/">EduTrack</a>. All Rights Reserved. Designed and Developed by <a href="https://ajaymahato9988.com.np" target="_blank" rel="noopener noreferrer">Ajay Mahato</a></p>
                        </div>
                        <div class="col-md-4 probootstrap-back-to-top">
                            <p><a href="#" class="js-backtotop">Back to top <img src="{{ asset('svg/arrow-up.svg') }}" alt="Top"></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    {{-- Modals --}}

    {{-- Edit Name Modal --}}
    <div class="modal fade" tabindex="-1" id="updateNameModal" role="dialog" aria-labelledby="updateNameModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('supdateName') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                        <h4 class="modal-title" id="updateNameModalLabel">Edit Full Name</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                        <div class="form-group">
                            <label for="name" class="control-label" style="font-weight: 600; color: #475569;">Full Name</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', Auth::user()->name) }}" placeholder="Enter Full Name" required>
                            @error('name', 'supdateName') <small style="color: #ef4444; font-weight: 600;">{{ $message }}</small> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 50px;">Cancel</button>
                        <button type="submit" class="btn btn-primary" style="border-radius: 50px; padding: 8px 24px;">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Change Password Modal --}}
    <div class="modal fade" tabindex="-1" id="updatePasswordModal" role="dialog" aria-labelledby="updatePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('supdatePassword') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                        <h4 class="modal-title" id="updatePasswordModalLabel">Change Password</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                        <div class="form-group">
                            <label for="password" class="control-label" style="font-weight: 600; color: #475569;">New Password</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Minimum 6 characters" required>
                            @error('password', 'supdatePassword') <small style="color: #ef4444; font-weight: 600;">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="control-label" style="font-weight: 600; color: #475569;">Confirm New Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Re-type new password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 50px;">Cancel</button>
                        <button type="submit" class="btn btn-primary" style="border-radius: 50px; padding: 8px 24px;">Update Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Update Profile Photo Modal --}}
    <div class="modal fade" tabindex="-1" id="updateProfileModal" role="dialog" aria-labelledby="updateProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('supdateProfile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                        <h4 class="modal-title" id="updateProfileModalLabel">Update Profile Picture</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                        <div class="form-group">
                            <label for="image" class="control-label" style="font-weight: 600; color: #475569;">Select Image (JPEG, PNG, JPG, Max 2MB)</label>
                            <input type="file" id="image" name="image" class="form-control" accept="image/jpeg,image/png,image/jpg" required style="padding: 6px;">
                            @error('image', 'supdateProfile') <small style="color: #ef4444; font-weight: 600;">{{ $message }}</small> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 50px;">Cancel</button>
                        <button type="submit" class="btn btn-primary" style="border-radius: 50px; padding: 8px 24px;">Upload Photo</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Scripts --}}
    <script src="{{ asset('js/student/scripts.min.js') }}"></script>
    <script src="{{ asset('js/student/main.min.js') }}"></script>
    <script src="{{ asset('js/student/custom.js') }}"></script>

    <script>
        $(document).ready(function() {
            @if ($errors->has('name') || $errors->hasBag('supdateName'))
                $('#updateNameModal').modal('show');
            @endif

            @if ($errors->has('password') || $errors->hasBag('supdatePassword'))
                $('#updatePasswordModal').modal('show');
            @endif

            @if ($errors->has('image') || $errors->hasBag('supdateProfile'))
                $('#updateProfileModal').modal('show');
            @endif
        });
    </script>
</body>

</html>

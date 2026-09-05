<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EduTrack</title>
    <meta name="description" content="Explore different courses prepared by top teachers of Nepal">
    <meta name="keywords" content="">

    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">

    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700|Open+Sans" rel="stylesheet">
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

        * {
            scroll-behavior: smooth;
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

        .probootstrap-header-top a:hover,
        .probootstrap-header-top a:focus {
            opacity: 1;
        }

        .probootstrap-top-quick-contact-info {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.75rem 1.5rem;
        }

        .probootstrap-top-quick-contact-info span {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }

        .probootstrap-top-social ul {
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
            padding-left: 0;
            margin: 0;
        }

        .probootstrap-top-social li {
            list-style: none;
        }

        .probootstrap-navbar {
            border: 0;
            box-shadow: 0 12px 30px -20px rgba(15, 23, 42, 0.45);
            min-height: 70px;
            transition: box-shadow 0.3s ease;
            background: #fff;
        }

        .probootstrap-navbar .navbar-brand img {
            width: 64px;
            transition: transform 0.3s ease;
        }

        .probootstrap-navbar .navbar-brand img:hover {
            transform: translateY(-3px);
        }

        .flexslider.hero-slider {
            position: relative;
        }

        .flexslider.hero-slider .slides>li {
            position: relative;
            background-size: cover;
            background-position: center;
        }

        .flexslider.hero-slider .slides>li::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(120deg, rgba(5, 25, 55, 0.8) 0%, rgba(12, 90, 219, 0.6) 100%);
        }

        /* Hero Slider: Hide side-to-side navigation buttons and keep clean full-width transitions */
        .flexslider.hero-slider .flex-direction-nav,
        .flexslider .flex-direction-nav {
            display: none !important;
            visibility: hidden !important;
            opacity: 0 !important;
            pointer-events: none !important;
        }


        .probootstrap-slider-text {
            position: relative;
            z-index: 2;
            max-width: 640px;
            margin: 0 auto;
        }

        .probootstrap-heading {
            font-size: clamp(2.25rem, 4vw, 3.75rem);
            line-height: 1.15;
            font-weight: 700;
            color: #fff;
            text-transform: none;
        }

        .probootstrap-section {
            padding: clamp(3rem, 6vw, 7rem) 0;
        }

        .probootstrap-flex-block {
            display: flex;
            align-items: center;
            gap: 2.5rem;
            flex-wrap: wrap;
        }

        .probootstrap-flex-block .probootstrap-text,
        .probootstrap-flex-block .probootstrap-image {
            flex: 1 1 320px;
        }

        .probootstrap-flex-block .probootstrap-image {
            min-height: 320px;
            border-radius: 22px;
            background-size: cover;
            background-position: center;
            box-shadow: 0 35px 80px -45px rgba(12, 90, 219, 0.65);
        }

        .probootstrap-flex-block .btn {
            border-radius: 9999px;
            padding: 0.75rem 1.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .probootstrap-service-2,
        .probootstrap-teacher,
        .probootstrap-testimony-wrap,
        .probootstrap-counter-wrap {
            background: #fff;
            border-radius: 20px;
            padding: 2.25rem 2rem;
            box-shadow: 0 32px 70px -40px rgba(15, 23, 42, 0.45);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .probootstrap-service-2:hover,
        .probootstrap-teacher:hover,
        .probootstrap-testimony-wrap:hover,
        .probootstrap-counter-wrap:hover {
            transform: translateY(-6px);
            box-shadow: 0 40px 95px -45px rgba(12, 90, 219, 0.45);
        }

        .probootstrap-service-2 h3 {
            font-weight: 700;
            color: var(--edu-secondary);
        }

        .probootstrap-counter {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--edu-primary);
        }

        .probootstrap-counter-label {
            font-size: 0.95rem;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .probootstrap-teacher img,
        .probootstrap-testimony-wrap figure img {
            border-radius: 16px;
            object-fit: cover;
            width: 100%;
            height: auto;
        }

        #testimonial .quote {
            color: #0f172a;
            font-size: 1rem;
            line-height: 1.8;
        }


        #testimonial {
            position: relative;
            background-size: cover;
            background-position: center;
            color: #0f172a;
            overflow: hidden;
        }

        #testimonial::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.85);
        }

        #testimonial>.container,
        #testimonial .owl-carousel {
            position: relative;
            z-index: 1;
        }

        .probootstrap-testimony-wrap blockquote.quote {
            position: relative;
            padding: 0 1.75rem;
            margin-top: 1.5rem;
            font-style: italic;
            color: var(--edu-secondary);
        }

        .probootstrap-testimony-wrap blockquote.quote::before {
            content: '"';
            position: absolute;
            left: 0;
            top: -0.75rem;
            font-size: 3rem;
            color: var(--edu-accent);
            opacity: 0.35;
        }

        footer.probootstrap-footer {
            color: #f9fafb;
        }

        footer.probootstrap-footer a {
            color: inherit;
        }


        .btn {
            border-radius: 9999px;
            padding: 0.75rem 1.75rem;
            font-weight: 600;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn.btn-primary {
            background: var(--edu-primary);
            border-color: var(--edu-primary);
            box-shadow: 0 18px 36px -20px rgba(12, 90, 219, 0.6);
        }

        .btn.btn-primary:hover,
        .btn.btn-primary:focus {
            background: #0940a1;
            border-color: #0940a1;
            transform: translateY(-2px);
            box-shadow: 0 22px 40px -22px rgba(5, 25, 55, 0.45);
        }

        @media (max-width: 992px) {
            .probootstrap-top-quick-contact-info {
                justify-content: center;
            }

            .probootstrap-top-social ul {
                justify-content: center;
            }

            .probootstrap-navbar .navbar-brand img {
                width: 56px;
            }

            .probootstrap-service-2,
            .probootstrap-teacher,
            .probootstrap-testimony-wrap,
            .probootstrap-counter-wrap {
                margin-bottom: 1.75rem;
            }

            .probootstrap-slider-text {
                text-align: center;
            }

            .probootstrap-navbar .navbar-collapse {
                background: #fff;
                border-radius: 16px;
                padding: 1rem 1.25rem;
                box-shadow: 0 35px 70px -40px rgba(15, 23, 42, 0.55);
            }

            .probootstrap-navbar .navbar-nav>li>a {
                color: var(--edu-secondary);
            }

            .probootstrap-navbar .navbar-nav>li>a:hover,
            .probootstrap-navbar .navbar-nav>li>a:focus {
                color: var(--edu-primary);
            }
        }

        @media (max-width: 768px) {
            .probootstrap-header-top {
                text-align: center;
            }

            .probootstrap-top-quick-contact-info {
                gap: 0.5rem 1rem;
            }

            .probootstrap-navbar {
                box-shadow: 0 10px 30px -18px rgba(15, 23, 42, 0.35);
            }

            .probootstrap-flex-block {
                flex-direction: column-reverse;
                text-align: center;
            }

            .probootstrap-slider-text {
                padding: 0 1rem;
            }
        }

        @media (max-width: 576px) {
            .probootstrap-top-quick-contact-info span {
                width: 100%;
                justify-content: center;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <div class="probootstrap-page-wrapper">
        <!-- Fixed navbar -->

        <div class="probootstrap-header-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-9 probootstrap-top-quick-contact-info">
                        <span><a href="https://www.google.com/maps/place/Bharatpur+44200/"
                                style="text-decoration: none">Bharatpur, Chitwan, Nepal</a></span>
                        <span><a href="https://api.whatsapp.com/send?phone=9779855033553"
                                style="text-decoration: none">+977 9855033553</a></span>
                        <span><a href="mailto:ajaymahato@notedinsights.com"
                                style="text-decoration: none">ajaymahato@notedinsights.com</a></span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 probootstrap-top-social">
                        <ul>
                            <li><a href="https://www.facebook.com/harekrishna431"><img
                                        src="{{ asset('svg/facebook.svg') }}" style="width: 18px"></a></li>
                            <li><a href="https://www.instagram.com/summerlove9988/"><img
                                        src="{{ asset('svg/instagram.svg') }}" style="width: 18px"></a></li>
                            <li><a href="https://twitter.com/ajaymahato9988"><img src="{{ asset('svg/twitter.svg') }}"
                                        style="width: 18px"></a></li>
                            {{-- <li><a href="#" class="probootstrap-search-icon js-probootstrap-search"><img
                                        src="{{ asset('svg/search.svg') }}" style="width: 18px"></a></li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-default probootstrap-navbar">
            <div class="container" style="height: 70px;">
                <div class="navbar-header" style="height: 70px;">
                    <div class="btn-more js-btn-more visible-xs">
                        <a href="#"><img src="{{ asset('svg/home.svg') }}" style="width: 18px; margin-top:-10px"></a>
                    </div>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#navbar-collapse" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/home" title="EduTrack">
                        <img src="{{ asset('img/logo.png') }}" style="width: 60px">
                    </a>
                </div>

                <div id="navbar-collapse" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="#home">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#course">Courses</a></li>
                        <li><a href="#teachers">Teachers</a></li>
                        <li><a href="#testimonial">Testimonial</a></li>

                        <li><a href="#contact">Contact</a></li>
                        <li>
                            <a href="/profile" style="display: flex; align-items: center; gap: 8px;">
                                <img src="{{ Auth::user()->avatar_url }}" style="width: 24px; height: 24px; border-radius: 50%; object-fit: cover; border: 1px solid #0c5adb;" alt="{{ Auth::user()->name }}">
                                <span>Profile</span>
                            </a>
                        </li>
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

        <section class="flexslider hero-slider" id="home">
            <ul class="slides">
                <li style="background-image: url('{{ asset('img/slider_1.jpg') }}')" class="overlay">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="text-center probootstrap-slider-text">
                                    <h1 class="probootstrap-heading probootstrap-animate">Your Bright Future is Our Mission</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li style="background-image: url('{{ asset('img/slider_2.jpg') }}')" class="overlay">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="text-center probootstrap-slider-text">
                                    <h1 class="probootstrap-heading probootstrap-animate">Education is Life</h1>
                                </div>
                            </div>
                        </div>
                    </div>

                </li>
                <li style="background-image: url('{{ asset('img/slider_3.jpg') }}')" class="overlay">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="text-center probootstrap-slider-text">
                                    <h1 class="probootstrap-heading probootstrap-animate">Helping Each of Our Students
                                        Fulfill the Potential</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </section>

        <section class="probootstrap-section probootstrap-section-colored" id="about">
            <div class="container">
                <div class="row">
                    <div class="text-left col-md-12 section-heading probootstrap-animate">
                        <h2>Welcome to EduTrack - An Online Education System</h2>
                    </div>
                </div>
            </div>
        </section>

        <section class="probootstrap-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="probootstrap-flex-block">
                            <div class="probootstrap-text probootstrap-animate">
                                <h3>About School</h3>
                                <p>Welcome to EduTrack! We're your all-in-one solution for effortless course management.
                                    Our user-friendly platform streamlines organization, communication, and learning.
                                    Educators create, manage, and deliver courses with ease, while students access
                                    materials and track progress seamlessly. Join us for an educational journey like no
                                    other!</p>
                                <p><a href="#" class="btn btn-primary">Learn More</a></p>
                            </div>
                            <div class="probootstrap-image probootstrap-animate"
                                style="background-image: url('{{ asset('img/balkumari.jpg') }}');">
                                <a href="https://www.youtube.com/watch?v=YJ4D_mJbp-Y" class="btn-video popup-vimeo"
                                    style="display: flex;
                  align-content:center; justify-content:center;"><img src="{{ asset('svg/play-button.svg') }}"
                                        style="width: 20%"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="probootstrap-section" id="probootstrap-counter">
            <div class="container">

                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 probootstrap-animate">
                        <div class="probootstrap-counter-wrap">
                            <div class="probootstrap-icon">
                                <img src="{{ asset('svg/user.svg') }}">
                            </div>
                            <div class="probootstrap-text">
                                <span class="probootstrap-counter">
                                    <span class="js-counter" data-from="0" data-to="20203" data-speed="5000"
                                        data-refresh-interval="50">1</span>
                                </span>
                                <span class="probootstrap-counter-label">Students Enrolled</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 probootstrap-animate">
                        <div class="probootstrap-counter-wrap">
                            <div class="probootstrap-icon">
                                <img src="{{ asset('svg/user-list.svg') }}">
                            </div>
                            <div class="probootstrap-text">
                                <span class="probootstrap-counter">
                                    <span class="js-counter" data-from="0" data-to="139" data-speed="5000"
                                        data-refresh-interval="50">1</span>
                                </span>
                                <span class="probootstrap-counter-label">Certified Teachers</span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix visible-sm-block visible-xs-block"></div>
                    <div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 probootstrap-animate">
                        <div class="probootstrap-counter-wrap">
                            <div class="probootstrap-icon">
                                <img src="{{ asset('svg/bookmark.svg') }}">
                            </div>
                            <div class="probootstrap-text">
                                <span class="probootstrap-counter">
                                    <span class="js-counter" data-from="0" data-to="99" data-speed="5000"
                                        data-refresh-interval="50">1</span>%
                                </span>
                                <span class="probootstrap-counter-label">Passing to Universities</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 probootstrap-animate">

                        <div class="probootstrap-counter-wrap">
                            <div class="probootstrap-icon">
                                <img src="{{ asset('svg/clipboard.svg') }}">
                            </div>
                            <div class="probootstrap-text">
                                <span class="probootstrap-counter">
                                    <span class="js-counter" data-from="0" data-to="100" data-speed="5000"
                                        data-refresh-interval="50">1</span>%
                                </span>
                                <span class="probootstrap-counter-label">Parents Satisfaction</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="probootstrap-section probootstrap-bg-white probootstrap-border-top" id="course">
            <div class="container">
                <div class="row">
                    <div class="text-center col-md-6 col-md-offset-3 section-heading probootstrap-animate">
                        <h2>Our Featured Courses</h2>
                        <p class="lead">Unlock Your Potential with Our Premium Curriculum</p>
                    </div>
                </div>

                @if (session('success'))
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="alert alert-success alert-dismissible fade in" role="alert" style="border-radius: 12px; font-weight: 600; margin-bottom: 30px;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
                            <strong>Success!</strong> {{ session('success') }}
                        </div>
                    </div>
                </div>
                @endif

                <!-- END row -->
                <div class="row">
                    @forelse($courses as $data)
                    <div class="col-md-6" style="margin-bottom: 30px;">
                        <div class="probootstrap-service-2 probootstrap-animate" style="height: 100%; display: flex; flex-direction: column; justify-content: space-between;">
                            <div class="text" style="width:100%;">
                                <div style="display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 12px;">
                                    <span class="label label-primary" style="font-size: 12px; border-radius: 12px; padding: 4px 10px; background: #0c5adb;">
                                        {{ $data->credit_hours }} Credit {{ $data->credit_hours == 1 ? 'Hour' : 'Hours' }}
                                    </span>
                                    <span class="label label-success" style="font-size: 13px; border-radius: 12px; padding: 4px 10px; background: #10b981; font-weight: 700;">
                                        Rs. {{ number_format($data->fee) }}
                                    </span>
                                    <span class="label label-default" style="font-size: 12px; border-radius: 12px; padding: 4px 10px;">
                                        {{ $data->students()->count() }} Enrolled
                                    </span>
                                </div>
                                <h3 style="font-weight: 700; color: #051937; margin-bottom: 10px;">{{ $data->course_name }}</h3>
                                <p style="color: #64748b; line-height: 1.6; margin-bottom: 20px;">
                                    Comprehensive learning module designed by expert educators. Gain practical skills, earn certified credits, and accelerate your academic career.
                                </p>
                                <p>
                                    <a href="#addStudentModal_{{ $data->id }}" class="btn btn-primary" data-toggle="modal" style="border-radius: 50px; font-weight: 600; padding: 8px 24px;">
                                        Enroll Now &bull; Rs. {{ number_format($data->fee) }}
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for each course -->
                    <div class="modal fade" tabindex="-1" id="addStudentModal_{{ $data->id }}" role="dialog">
                        <div class="modal-dialog" role="document">
                            <form action="{{ route('enrollStudent') }}" method="POST">
                                @csrf
                                <div class="modal-content" style="border-radius: 16px; overflow: hidden; border: none; box-shadow: 0 20px 50px rgba(0,0,0,0.2);">
                                    <div class="modal-header" style="background: linear-gradient(135deg, #051937 0%, #0c5adb 100%); color: #fff; padding: 20px 24px;">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff; opacity: 0.85;">&times;</button>
                                        <h4 class="modal-title" style="color: #fff; font-weight: 700;">Enroll in {{ $data->course_name }}</h4>
                                    </div>
                                    <div class="modal-body" style="padding: 24px;">
                                        <div class="form-group">
                                            <label for="name_{{ $data->id }}" style="font-weight: 600; color: #334155;">Full Name</label>
                                            <input type="text" name="name" id="name_{{ $data->id }}" class="form-control"
                                                value="{{ old('name', auth()->user()->name) }}" placeholder="Enter Full Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="sex_{{ $data->id }}" style="font-weight: 600; color: #334155;">Gender</label>
                                            <select name="sex" id="sex_{{ $data->id }}" class="form-control" required>
                                                <option value="" {{ old('sex') ? '' : 'selected' }}>Select Gender</option>
                                                <option value="male" {{ old('sex')=='male' ? 'selected' : '' }}>Male</option>
                                                <option value="female" {{ old('sex')=='female' ? 'selected' : '' }}>Female</option>
                                                <option value="other" {{ old('sex')=='other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone_{{ $data->id }}" style="font-weight: 600; color: #334155;">Phone Number</label>
                                            <input type="tel" name="phone" id="phone_{{ $data->id }}" class="form-control"
                                                value="{{ old('phone') }}" placeholder="Enter Phone Number" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="address_{{ $data->id }}" style="font-weight: 600; color: #334155;">Residential Address</label>
                                            <input type="text" name="address" id="address_{{ $data->id }}" class="form-control"
                                                value="{{ old('address') }}" placeholder="City / Address" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="course_id_{{ $data->id }}" style="font-weight: 600; color: #334155;">Course</label>
                                            <select name="course_id" id="course_id_{{ $data->id }}" class="form-control" required>
                                                @foreach ($courses as $course)
                                                <option value="{{ $course->id }}" {{ old('course_id', $data->id) == $course->id ? 'selected' : ''}}>
                                                    {{ $course->course_name }} (Rs. {{ number_format($course->fee) }})
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-0">
                                            <label for="paid_fee_{{ $data->id }}" style="font-weight: 600; color: #334155;">Paid Fee (Rs.)</label>
                                            <input type="number" name="paid_fee" id="paid_fee_{{ $data->id }}" class="form-control"
                                                value="{{ old('paid_fee', $data->fee) }}" placeholder="Tuition Fee"
                                                required min="0">
                                        </div>
                                    </div>
                                    <div class="modal-footer" style="background: #f8fafc; padding: 16px 24px;">
                                        <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 50px;">Cancel</button>
                                        <input type="submit" class="btn btn-success" value="Confirm Enrollment" style="border-radius: 50px; padding: 8px 24px; font-weight: 600;">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="col-md-12 text-center" style="padding: 60px 0;">
                        <h3 style="color: #64748b;">No Courses Available Currently</h3>
                        <p>Please check back shortly for upcoming curriculum schedules.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="probootstrap-section" id="teachers">
            <div class="container">
                <div class="row">
                    <div class="text-center col-md-6 col-md-offset-3 section-heading probootstrap-animate">
                        <h2>Meet Our Qualified Teachers</h2>
                        <p class="lead">Meet the Experts: Our Dedicated Teachers Await</p>
                    </div>
                </div>
                <!-- END row -->

                <div class="" style="display: grid;
          grid-template-columns: 1fr 1fr 1fr;">
                    @forelse($teachers as $data)
                    {{-- <div class="col-md-4 col-sm-6"> --}}
                        <div class="text-center probootstrap-teacher probootstrap-animate" style="margin: 10px 10px;">
                            <figure class="media">
                                <img src="storage/{{ $data->profile_photo_path }}" alt="" class="img-responsive">
                            </figure>
                            <div class="text">
                                <h3 style="font-weight: bold">{{ $data->name }}</h3>
                                <p>Email: {{ $data->email }}</p>
                            </div>
                        </div>
                        {{--
                    </div> --}}
                    @empty
                    <h2>No Teachers found</h2>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="probootstrap-section probootstrap-bg probootstrap-section-colored probootstrap-testimonial"
            style="background-image: url('{{ asset('img/testimonial.jpg') }}');" id="testimonial">
            <div class="container">
                <div class="row">
                    <div class="text-center col-md-6 col-md-offset-3 section-heading probootstrap-animate">
                        <h2>Testimonial</h2>
                        <p class="lead">Real Stories, Real Success: Hear From Our Students</p>
                    </div>
                </div>
                <!-- END row -->
                <div class="row">
                    <div class="col-md-12 probootstrap-animate">
                        <div class="owl-carousel owl-carousel-testimony owl-carousel-fullwidth">
                            <div class="item">

                                <div class="text-center probootstrap-testimony-wrap">
                                    <figure>
                                        <img src="{{ asset('img/person_1.jpg') }}"
                                            alt="Free Bootstrap Template by uicookies.com">
                                    </figure>
                                    <blockquote class="quote">&ldquo;EduTrack has revolutionized the way I learn. The
                                        courses are engaging, the instructors are knowledgeable, and the support team is
                                        always there when I need assistance. Highly recommended!&rdquo; <cite
                                            class="author"> &mdash; <span> Ajay Mahato</span></cite></blockquote>
                                </div>

                            </div>
                            <div class="item">
                                <div class="text-center probootstrap-testimony-wrap">
                                    <figure>
                                        <img src="{{ asset('img/person_2.jpg') }}"
                                            alt="Free Bootstrap Template by uicookies.com">
                                    </figure>
                                    <blockquote class="quote">&ldquo;I've been using EduTrack for a year now, and I
                                        couldn't be happier with my progress. The courses are well-structured, easy to
                                        follow, and have helped me advance in my career. Thank you, EduTrack!&rdquo;
                                        <cite class="author"> &mdash;<span> Roshan Kunwar</span></cite>
                                    </blockquote>
                                </div>
                            </div>
                            <div class="item">
                                <div class="text-center probootstrap-testimony-wrap">
                                    <figure>
                                        <img src="{{ asset('img/person_3.jpg') }}"
                                            alt="Free Bootstrap Template by uicookies.com">
                                    </figure>
                                    <blockquote class="quote">&ldquo;EduTrack has exceeded my expectations. The
                                        instructors are passionate about teaching, the platform is user-friendly, and
                                        the community is supportive. I've learned so much and feel more confident in my
                                        skills.&rdquo; <cite class="author">&mdash; <span> Rajesh Sapkota</span></cite>
                                    </blockquote>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- END row -->
            </div>
        </section>

        <section class="probootstrap-section">
            <div class="container">
                <div class="row">
                    <div class="text-center col-md-6 col-md-offset-3 section-heading probootstrap-animate">
                        <h2>Why Choose EduTrack?</h2>
                        <p class="lead">EduTrack stands out for its unparalleled commitment to excellence in
                            education.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="service left-icon probootstrap-animate">
                            <div class="icon"><img src="{{ asset('svg/check.svg') }}"></div>
                            <div class="text">
                                <h3>Expert Instructors</h3>
                                <p>Our dedicated educators bring years of experience and expertise to the classroom,
                                    ensuring a high-quality learning experience.
                                </p>
                            </div>
                        </div>
                        <div class="service left-icon probootstrap-animate">
                            <div class="icon"><img src="{{ asset('svg/check.svg') }}"></div>
                            <div class="text">
                                <h3>Comprehensive Courses</h3>
                                <p>From foundational concepts to advanced topics, our courses cover a wide range of
                                    subjects, providing learners with a well-rounded education.
                                </p>
                            </div>
                        </div>
                        <div class="service left-icon probootstrap-animate">
                            <div class="icon"><img src="{{ asset('svg/check.svg') }}"></div>
                            <div class="text">
                                <h3>Interactive Learning</h3>
                                <p>Engaging lessons, interactive activities, and real-world examples make learning
                                    enjoyable and effective.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="service left-icon probootstrap-animate">
                            <div class="icon"><img src="{{ asset('svg/check.svg') }}"></div>
                            <div class="text">
                                <h3>Flexible Learning</h3>
                                <p>With anytime, anywhere access to course materials, students can learn at their own
                                    pace and on their own schedule.
                                </p>
                            </div>
                        </div>

                        <div class="service left-icon probootstrap-animate">
                            <div class="icon"><img src="{{ asset('svg/check.svg') }}"></div>
                            <div class="text">
                                <h3>Supportive Community</h3>
                                <p>Join a vibrant community of learners and educators who are passionate about knowledge
                                    sharing and collaboration.</p>
                            </div>
                        </div>

                        <div class="service left-icon probootstrap-animate">
                            <div class="icon"><img src="{{ asset('svg/check.svg') }}"></div>
                            <div class="text">
                                <h3>Cutting-Edge Technology</h3>
                                <p>Our state-of-the-art platform leverages the latest technology to deliver an intuitive
                                    and seamless learning experience.</p>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- END row -->
            </div>
        </section>

        <section class="probootstrap-cta">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="probootstrap-animate" data-animate-effect="fadeInRight">Get your admission now!
                        </h2>
                        <a href="#course" role="button" class="btn btn-primary btn-lg btn-ghost probootstrap-animate"
                            data-animate-effect="fadeInLeft">Enroll</a>
                    </div>
                </div>
            </div>
        </section>
        <footer class="probootstrap-footer" id="contact" style="background: rgb(2,0,36);
      background: linear-gradient(200deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 35%, rgba(0,212,255,1) 100%);">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="probootstrap-footer-widget">
                            <h3>About The EduTrack</h3>
                            <p>We're your all-in-one solution for effortless course management. Our user-friendly
                                platform streamlines organization, communication, and learning. Educators create,
                                manage, and deliver courses with ease, while students access materials and track
                                progress seamlessly. Join us for an educational journey like no other!</p>
                            <h3>Social</h3>
                            <ul class="probootstrap-footer-social">
                                <li><a href="https://www.facebook.com/harekrishna431"><img
                                            src="{{ asset('svg/facebook.svg') }}" style="width: 18px"></a></li>
                                <li><a href="https://www.instagram.com/summerlove9988/"><img
                                            src="{{ asset('svg/instagram.svg') }}" style="width: 18px"></a></li>
                                <li><a href="https://twitter.com/ajaymahato9988"><img
                                            src="{{ asset('svg/twitter.svg') }}" style="width: 18px"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-md-push-1">
                        <div class="probootstrap-footer-widget">
                            <h3>Links</h3>
                            <ul>
                                <li><a href="#home">Home</a></li>
                                <li><a href="#about">About</a></li>
                                <li><a href="#course">Courses</a></li>
                                <li><a href="#teachers">Teachers</a></li>
                                <li><a href="#testimonial">Testimonial</a></li>
                                <li><a href="/logout">Log Out</a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="probootstrap-footer-widget">
                            <h3>Contact Info</h3>
                            <ul class="probootstrap-contact-info">
                                <li><span><a href="https://www.google.com/maps/place/Bharatpur+44200/"
                                            style="text-decoration: none">Bharatpur, Chitwan, Nepal</a></span>
                                </li>
                                <li><span><a href="mailto:ajaymahato@notedinsights.com"
                                            style="text-decoration: none">ajaymahato@notedinsights.com</a></span>
                                </li>
                                <li><span><a href="https://api.whatsapp.com/send?phone=9779855033553"
                                            style="text-decoration: none">+977 9855033553</a></span>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <!-- END row -->

            </div>

            <div class="probootstrap-copyright">
                <div class="container">
                    <div class="row">
                        <div class="text-left col-md-8">
                            <p>&copy; {{ now()->year }} <a href="https://notedinsights.com/">EduTrack</a>. All Rights
                                Reserved.
                                Designed and Developed by <a href="https://ajaymahato9988.com.np" target="_blank" rel="noopener noreferrer">Ajay Mahato</a>
                            </p>
                        </div>
                        <div class="col-md-4 probootstrap-back-to-top">
                            <p><a href="#" class="js-backtotop">Back to top <img
                                        src="{{ asset('svg/arrow-up.svg') }}"></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div>
    <!-- END wrapper -->



    <script src="{{ asset('js/student/scripts.min.js') }}"></script>
    <script src="{{ asset('js/student/main.min.js') }}"></script>
    <script src="{{ asset('js/student/custom.js') }}"></script>

    <script>
        $(document).ready(function() {
            if (typeof $.fn.flexslider === 'function') {
                $('.flexslider').flexslider({
                    animation: "fade",
                    directionNav: false,
                    controlNav: false,
                    slideshow: true,
                    slideshowSpeed: 4000,
                    animationSpeed: 800,
                    pauseOnHover: false,
                    pauseOnAction: false
                });
            }
        });
    </script>

</body>

</html>

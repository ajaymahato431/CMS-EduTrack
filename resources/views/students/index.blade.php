<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EduTrack</title>
    <meta name="description" content="Explore different courses prepared by top teachers of Nepal">
    <meta name="keywords" content="">

    <link rel="icon" type="image/x-icon" href="/storage/favicon.ico">

    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700|Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/student/styles-merged.css') }}">
    <link rel="stylesheet" href="{{ asset('css/student/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/student/custom.css') }}">

    <style>
        * {
            scroll-behavior: smooth;
        }
    </style>

    <!--[if lt IE 9]>
      <script src="js/vendor/html5shiv.min.js"></script>
      <script src="js/vendor/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <div class="probootstrap-search" id="probootstrap-search">
        <a href="#" class="probootstrap-close js-probootstrap-close"><img src="{{ asset('svg/cross.svg') }}"></a>
        <form action="#">
            <input type="search" name="s" id="search" placeholder="Search a keyword and hit enter...">
        </form>
    </div>

    <div class="probootstrap-page-wrapper">
        <!-- Fixed navbar -->

        <div class="probootstrap-header-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-9 probootstrap-top-quick-contact-info">
                        <span><a href="https://www.google.com/maps/place/Bharatpur+44200/"
                                style="text-decoration: none">Bharatpur, Chitwan, Nepal</a></span>
                        <span><a href="https://api.whatsapp.com/send?phone=9779855034052"
                                style="text-decoration: none">+977 9855034052</a></span>
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
                            <li><a href="#" class="probootstrap-search-icon js-probootstrap-search"><img
                                        src="{{ asset('svg/search.svg') }}" style="width: 18px"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-default probootstrap-navbar">
            <div class="container">
                <div class="navbar-header">
                    <div class="btn-more js-btn-more visible-xs">
                        <a href="#"><img src="{{ asset('svg/home.svg') }}"
                                style="width: 18px; margin-top:-10px"></a>
                    </div>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#navbar-collapse" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/home" title="EduTrack">
                        <img src="storage/logo.png" style="width: 60px">
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
                        <li><a href="/profile">Profile</a></li>

                    </ul>
                </div>
            </div>
        </nav>

        <section class="flexslider" id="home">
            <ul class="slides">
                <li style="background-image: url(storage/slider_1.jpg)" class="overlay">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="text-center probootstrap-slider-text">
                                    <h1 class="probootstrap-heading probootstrap-animate">Your Bright Future is Our
                                        Mission</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li style="background-image: url(storage/slider_2.jpg)" class="overlay">
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
                <li style="background-image: url(storage/slider_3.jpg)" class="overlay">
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
                                style="background-image: url(storage/balkumari.jpg);">
                                <a href="https://www.youtube.com/watch?v=YJ4D_mJbp-Y" class="btn-video popup-vimeo"
                                    style="display: flex;
                  align-content:center; justify-content:center;"><img
                                        src="{{ asset('svg/play-button.svg') }}" style="width: 20%"></a>
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
                        <p class="lead">Unlock Your Potential with Our Premium Courses</p>
                    </div>
                </div>
                <!-- END row -->
                <div class="row">

                    @forelse($courses as $data)
                        <div class="col-md-6">
                            <div class="probootstrap-service-2 probootstrap-animate">
                                <div class="text" style="width:100%;">
                                    <h3 style="font-weight: bold">{{ $data->course_name }}</h3>
                                    <p>Disclaimer: The following course description is for demonstration purposes only
                                        and does not represent actual course content or offerings.</p>
                                    <p><a href="#addStudentModal_{{ $data->id }}" class="btn btn-primary"
                                            data-toggle="modal">Enroll now</a></p>
                                </div>
                            </div>
                        </div>

                        <!-- Modal for each course -->
                        <div class="modal fade" tabindex="-1" id="addStudentModal_{{ $data->id }}"
                            role="dialog">
                            <div class="modal-dialog" role="document">
                                <form action="{{ route('enrollStudent') }}" method="POST">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Enroll Now</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', auth()->user()->name) }}"
                                                       placeholder="Enter Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="sex">Sex</label>
                                                <select name="sex" id="sex" class="form-control" required>
                                                    <option value="" {{ old('sex') ? '' : 'selected' }}>Select Sex</option>
                                                    <option value="male" {{ old('sex') == 'male' ? 'selected' : '' }}>Male</option>
                                                    <option value="female" {{ old('sex') == 'female' ? 'selected' : '' }}>Female</option>
                                                    <option value="other" {{ old('sex') == 'other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="tel" name="phone" id="phone" class="form-control" value="{{ old('phone') }}"
                                                       placeholder="Enter Phone" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}"
                                                       placeholder="Enter Address" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="course_id">Course</label>
                                                <select name="course_id" id="course_id" class="form-control" required>
                                                    <option value="" {{ old('course_id') ? '' : 'selected' }}>Select Course</option>
                                                    @foreach ($courses as $course)
                                                        <option value="{{ $course->id }}" {{ old('course_id', $data->id ) == $course->id ? 'selected' : ''}}>
                                                            {{ $course->course_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="paid_fee">Paid Fee</label>
                                                <input type="number" name="paid_fee" id="paid_fee" class="form-control" value="{{ old('paid_fee', $data->fee) }}"
                                                       placeholder="Enter Paid Fee" required min="0">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <input type="submit" class="btn btn-success" value="Enroll">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @empty
                        <h2>No Courses found</h2>
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
                                <img src="storage/{{ $data->profile_photo_path }}" alt=""
                                    class="img-responsive">
                            </figure>
                            <div class="text">
                                <h3 style="font-weight: bold">{{ $data->name }}</h3>
                                <p>Email: {{ $data->email }}</p>
                            </div>
                        </div>
                        {{-- </div> --}}
                    @empty
                        <h2>No Teachers found</h2>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="probootstrap-section probootstrap-bg probootstrap-section-colored probootstrap-testimonial"
            style="background-image: url(storage/testimonial.jpg);" id="testimonial">
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
                                        <img src="storage/person_1.jpg"
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
                                        <img src="storage/person_2.jpg"
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
                                        <img src="storage/person_3.jpg"
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
                        <a href="#course" role="button"
                            class="btn btn-primary btn-lg btn-ghost probootstrap-animate"
                            data-animate-effect="fadeInLeft">Enroll</a>
                    </div>
                </div>
            </div>
        </section>
        <footer class="probootstrap-footer" id="contact"
            style="background: rgb(2,0,36);
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
                                <li><span><a href="https://api.whatsapp.com/send?phone=9779855034052"
                                            style="text-decoration: none">+977 9855034052</a></span>
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
                            <p>&copy; 2024 <a href="https://notedinsights.com/">EduTrack</a>. All Rights Reserved.
                                Designed &amp; Developed by <a href="https://ajaymahato9988.com.np/">Ajay Mahato</a>
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

</body>

</html>

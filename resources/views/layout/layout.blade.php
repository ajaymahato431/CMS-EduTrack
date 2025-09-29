<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>CMS - EduTrack</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">


    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">

</head>

<body>

    <div class="wrapper">

        <div class="body-overlay"></div>

        @if (Auth::user()->role_id === 1)
        @include('layout.sidebar')
        @else
        @include('layout.teacher-sidebar')
        @endif

        <div id="content">

            <div class="top-navbar">
                <div class="xd-topbar">
                    <div class="row">
                        <div class="order-2 col-2 col-md-1 col-lg-1 order-md-1 align-self-center">
                            <div class="xp-menubar">
                                <span class="text-white material-icons">signal_cellular_alt</span>
                            </div>
                        </div>

                        <div class="order-3 col-md-5 col-lg-3 order-md-2">
                            <div class="xp-searchbar">
                                <form>
                                    <div class="input-group">
                                        <input type="search" class="form-control" placeholder="Search">
                                        <div class="input-group-append">
                                            <button class="btn" type="submit" id="button-addon2">Go
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <div class="order-1 col-10 col-md-6 col-lg-8 order-md-3">
                            <div class="text-right xp-profilebar">
                                <nav class="p-0 navbar">
                                    <ul class="flex-row ml-auto nav navbar-nav">

                                        <li class="dropdown nav-item">
                                            <a class="nav-link" href="#" data-toggle="dropdown">
                                                <img src="/storage/{{ Auth::user()->profile_photo_path }}"
                                                    style="width:40px; height:40px; object-fit:cover; border-radius:50%;" />
                                                <span class="xp-user-live"></span>
                                            </a>
                                            <ul class="dropdown-menu small-menu">
                                                <li><a href="/logout">
                                                        <span class="material-icons">logout</span>
                                                        Logout
                                                    </a></li>

                                            </ul>
                                        </li>


                                    </ul>
                                </nav>
                            </div>
                        </div>

                    </div>

                    <div class="text-center xp-breadcrumbbar">
                        <h4 class="page-title">Dashboard</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">EduTrack</a></li>
                            <li class="breadcrumb-item active" aria-curent="page">Dashboard</li>
                        </ol>
                    </div>


                </div>
            </div>
            <div class="body-area" style="min-height: 70vh;
      padding: 20px">
                @yield('content')
            </div>


            @include('layout.footer');

        </div>

    </div>

    <script src="{{ asset('js/jquery-3.3.1.slim.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    {{-- Sidebar Toggle Script --}}
    <script type="text/javascript">
        $(document).ready(function () {
            $(".xp-menubar").on('click', function () {
                $("#sidebar").toggleClass('active');
                $("#content").toggleClass('active');
            });

            $('.xp-menubar,.body-overlay').on('click', function () {
                $("#sidebar,.body-overlay").toggleClass('show-nav');
            });

        });
    </script>

    {{-- This is where scripts from other pages will be injected --}}
    @stack('scripts')


</body>

</html>

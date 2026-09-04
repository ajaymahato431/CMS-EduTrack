<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('page_title', 'Dashboard') &bull; EduTrack</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <div class="body-overlay"></div>

        @if (Auth::check() && Auth::user()->isAdmin())
            @include('layout.sidebar')
        @else
            @include('layout.teacher-sidebar')
        @endif

        <div id="content">
            <div class="top-navbar">
                <div class="xd-topbar">
                    <div class="align-items-center row">
                        <div class="order-2 col-2 col-md-1 align-self-center order-md-1">
                            <div class="xp-menubar" title="Toggle Navigation">
                                <span class="text-white material-icons">menu</span>
                            </div>
                        </div>

                        <div class="order-3 col-12 col-md-5 col-lg-4 order-md-2 mt-md-0 mt-2">
                            <div class="xp-searchbar">
                                <form onsubmit="return false;">
                                    <div class="input-group">
                                        <input type="search" class="form-control" placeholder="Quick search in table..." aria-label="Search">
                                        <div class="input-group-append">
                                            <button class="btn" type="submit" id="button-addon2">
                                                <i class="material-icons" style="font-size: 18px; vertical-align: middle;">search</i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="order-1 col-10 col-md-6 col-lg-7 order-md-3">
                            <div class="text-right xp-profilebar">
                                <nav class="p-0 navbar justify-content-end">
                                    <ul class="flex-row ml-auto align-items-center nav navbar-nav">
                                        @auth
                                        <li class="dropdown nav-item">
                                            <a class="nav-link d-flex align-items-center text-white" href="#" data-toggle="dropdown" style="gap: 8px;">
                                                <img src="{{ Auth::user()->avatar_url }}"
                                                     alt="{{ Auth::user()->name }}"
                                                     style="width: 38px; height: 38px; object-fit: cover; border-radius: 50%; border: 2px solid rgba(255,255,255,0.3);" />
                                                <div class="d-none d-md-block text-left" style="line-height: 1.2;">
                                                    <div style="font-size: 13px; font-weight: 600;">{{ Auth::user()->name }}</div>
                                                    <small class="text-muted" style="color: #cbd5e1 !important; font-size: 11px;">
                                                        {{ Auth::user()->role?->role_name ?? (Auth::user()->isAdmin() ? 'Admin' : 'Teacher') }}
                                                    </small>
                                                </div>
                                                <span class="material-icons" style="font-size: 18px; opacity: 0.8;">arrow_drop_down</span>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-right shadow-sm border-0 py-2" style="min-width: 220px; border-radius: 10px;">
                                                <li class="px-3 py-2 border-bottom">
                                                    <div style="font-weight: 600; color: #1e293b; font-size: 14px;">{{ Auth::user()->name }}</div>
                                                    <div class="text-muted small">{{ Auth::user()->email }}</div>
                                                </li>
                                                <li>
                                                    <a href="{{ Auth::user()->isAdmin() ? '/admin' : '/teacher' }}" class="dropdown-item d-flex align-items-center py-2">
                                                        <span class="material-icons mr-2" style="font-size: 18px;">dashboard</span>
                                                        Dashboard
                                                    </a>
                                                </li>
                                                <div class="dropdown-divider my-1"></div>
                                                <li>
                                                    <a href="/logout" class="dropdown-item d-flex align-items-center py-2 text-danger">
                                                        <span class="material-icons mr-2" style="font-size: 18px;">logout</span>
                                                        Logout
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        @endauth
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <div class="xp-breadcrumbbar mt-3 pt-2 border-top border-secondary">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <h4 class="page-title mb-0">@yield('page_title', 'Dashboard')</h4>
                            <ol class="breadcrumb mb-0 py-0">
                                <li class="breadcrumb-item"><a href="{{ Auth::user()?->isAdmin() ? '/admin' : '/teacher' }}">EduTrack</a></li>
                                @yield('breadcrumb')
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="body-area" style="min-height: calc(100vh - 200px); padding: 24px 30px;">
                @yield('content')
            </div>

            @include('layout.footer')
        </div>
    </div>

    <!-- Core JavaScript Files (Single canonical load) -->
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!-- Sidebar Toggle Script -->
    <script type="text/javascript">
        $(document).ready(function () {
            $(".xp-menubar").on('click', function () {
                $("#sidebar").toggleClass('active');
                $("#content").toggleClass('active');
            });

            $('.xp-menubar, .body-overlay').on('click', function () {
                $("#sidebar, .body-overlay").toggleClass('show-nav');
            });
        });
    </script>

    @stack('scripts')
</body>
</html>

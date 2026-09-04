<div id="sidebar">
    <div class="sidebar-header">
        <a href="/teacher" class="d-flex align-items-center text-decoration-none">
            <img src="{{ asset('img/logo.png') }}" class="img-fluid" style="width: 40px; margin-right: 12px;" alt="EduTrack" />
            <h3 class="mb-0 font-weight-bold" style="letter-spacing: 0.5px; color: #1e293b;">Edu<span style="color: #4f46e5;">Track</span></h3>
        </a>
    </div>

    <ul class="m-0 list-unstyled component">
        <li class="{{ request()->is('teacher') || request()->is('teacher/dashboard') ? 'active' : '' }}">
            <a href="/teacher" class="dashboard">
                <i class="material-icons">dashboard</i>
                <span>Dashboard</span>
            </a>
        </li>

        @php
            $isCourseActive = request()->is('teacher/course*');
        @endphp
        <li class="dropdown {{ $isCourseActive ? 'active' : '' }}">
            <a href="#tCourseSubmenu" data-toggle="collapse" aria-expanded="{{ $isCourseActive ? 'true' : 'false' }}" class="dropdown-toggle">
                <i class="material-icons">menu_book</i>
                <span>Courses</span>
            </a>
            <ul class="collapse list-unstyled menu {{ $isCourseActive ? 'show' : '' }}" id="tCourseSubmenu">
                <li class="{{ request()->is('teacher/course*') ? 'active' : '' }}">
                    <a href="/teacher/course">Manage Courses</a>
                </li>
            </ul>
        </li>

        @php
            $isStudentsActive = request()->is('teacher/students*');
        @endphp
        <li class="dropdown {{ $isStudentsActive ? 'active' : '' }}">
            <a href="#tStudentsSubmenu" data-toggle="collapse" aria-expanded="{{ $isStudentsActive ? 'true' : 'false' }}" class="dropdown-toggle">
                <i class="material-icons">school</i>
                <span>Students</span>
            </a>
            <ul class="collapse list-unstyled menu {{ $isStudentsActive ? 'show' : '' }}" id="tStudentsSubmenu">
                <li class="{{ request()->is('teacher/students*') ? 'active' : '' }}">
                    <a href="/teacher/students">Manage Students</a>
                </li>
            </ul>
        </li>

        <li class="mt-4 border-top pt-2">
            <a href="/logout" class="text-danger">
                <i class="material-icons text-danger">logout</i>
                <span>Logout</span>
            </a>
        </li>
    </ul>
</div>

<div id="sidebar">
    <div class="sidebar-header">
        <a href="/admin" class="d-flex align-items-center text-decoration-none">
            <img src="{{ asset('img/logo.png') }}" class="img-fluid" style="width: 40px; margin-right: 12px;" alt="EduTrack" />
            <h3 class="mb-0 font-weight-bold" style="letter-spacing: 0.5px; color: #1e293b;">Edu<span style="color: #4f46e5;">Track</span></h3>
        </a>
    </div>

    <ul class="m-0 list-unstyled component">
        <li class="{{ request()->is('admin') || request()->is('admin/dashboard') ? 'active' : '' }}">
            <a href="/admin" class="dashboard">
                <i class="material-icons">dashboard</i>
                <span>Dashboard</span>
            </a>
        </li>

        @php
            $isUsersActive = request()->is('admin/users*') || request()->is('admin/manage-role*');
        @endphp
        <li class="dropdown {{ $isUsersActive ? 'active' : '' }}">
            <a href="#usersSubmenu" data-toggle="collapse" aria-expanded="{{ $isUsersActive ? 'true' : 'false' }}" class="dropdown-toggle">
                <i class="material-icons">people</i>
                <span>Users</span>
            </a>
            <ul class="collapse list-unstyled menu {{ $isUsersActive ? 'show' : '' }}" id="usersSubmenu">
                <li class="{{ request()->is('admin/users*') ? 'active' : '' }}">
                    <a href="/admin/users">View Users</a>
                </li>
                <li class="{{ request()->is('admin/manage-role*') ? 'active' : '' }}">
                    <a href="/admin/manage-role">Manage Roles</a>
                </li>
            </ul>
        </li>

        @php
            $isCourseActive = request()->is('admin/course*');
        @endphp
        <li class="dropdown {{ $isCourseActive ? 'active' : '' }}">
            <a href="#courseSubmenu" data-toggle="collapse" aria-expanded="{{ $isCourseActive ? 'true' : 'false' }}" class="dropdown-toggle">
                <i class="material-icons">menu_book</i>
                <span>Courses</span>
            </a>
            <ul class="collapse list-unstyled menu {{ $isCourseActive ? 'show' : '' }}" id="courseSubmenu">
                <li class="{{ request()->is('admin/course*') ? 'active' : '' }}">
                    <a href="/admin/course">Manage Courses</a>
                </li>
            </ul>
        </li>

        @php
            $isStudentsActive = request()->is('admin/students*');
        @endphp
        <li class="dropdown {{ $isStudentsActive ? 'active' : '' }}">
            <a href="#studentsSubmenu" data-toggle="collapse" aria-expanded="{{ $isStudentsActive ? 'true' : 'false' }}" class="dropdown-toggle">
                <i class="material-icons">school</i>
                <span>Students</span>
            </a>
            <ul class="collapse list-unstyled menu {{ $isStudentsActive ? 'show' : '' }}" id="studentsSubmenu">
                <li class="{{ request()->is('admin/students*') ? 'active' : '' }}">
                    <a href="/admin/students">Manage Students</a>
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

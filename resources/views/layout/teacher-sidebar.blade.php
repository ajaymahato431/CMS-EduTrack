<div id="sidebar">
    <div class="sidebar-header">
        <h3><img src="{{ asset('img/logo.png') }}" class="img-fluid" /><span>EduTrack</span></h3>
    </div>
    <ul class="m-0 list-unstyled component">
        <li class="active">
            <a href="/" class="dashboard"><i class="material-icons">dashboard</i>Dashboard </a>
        </li>

        <li class="dropdown">
            <a href="#homeSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="material-icons">aspect_ratio</i>Course
            </a>
            <ul class="collapse list-unstyled menu" id="homeSubmenu2">
                <li><a href="/teacher/course">Manage Course</a></li>

            </ul>
        </li>

        <li class="dropdown">
            <a href="#homeSubmenu3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="material-icons">equalizer</i>Students
            </a>
            <ul class="collapse list-unstyled menu" id="homeSubmenu3">
                <li><a href="/teacher/students">Manage Students</a></li>


            </ul>
        </li>

        <li class="dropdown">
            <a href="/logout">
                <i class="material-icons">extension</i>Log Out
            </a>
        </li>
    </ul>
</div>

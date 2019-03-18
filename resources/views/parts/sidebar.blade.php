<!-- Sidebar -->
<div class="site-sidebar-overlay"></div>
<div class="site-sidebar">
    <a class="logo" href="index.html">
        <span class="l-text">Neptune</span>
        <span class="l-icon"></span>
    </a>
    <div class="custom-scroll custom-scroll-light">
        <ul class="sidebar-menu">
            <li class="menu-title m-t-0-5">Navigation</li>
            <li>
                <a href="/" class="waves-effect  waves-light">
                    <span class="s-icon"><i class="ti-dashboard"></i></span>
                    <span class="s-text">Home</span>
                </a>
            </li>


            <li>
                <a href="{{route("allSubmissions")}}" class="waves-effect  waves-light">
                    <span class="s-icon"><i class="ti-dashboard"></i></span>
                    <span class="s-text">Submissions</span>
                </a>
            </li>

            <li class="menu-title">Management</li>
            <li>
                <a href="{{route("manageUsers")}}" class="waves-effect  waves-light">
                    <span class="s-icon"><i class="ti-dashboard"></i></span>
                    <span class="s-text">Manage Users</span>
                </a>
            </li>
            <li>
                <a href="{{route("manageClosures")}}" class="waves-effect  waves-light">
                    <span class="s-icon"><i class="ti-dashboard"></i></span>
                    <span class="s-text">Manage Closures</span>
                </a>
            </li>
            <li>
                <a href="{{route("showFaculties")}}" class="waves-effect  waves-light">
                    <span class="s-icon"><i class="ti-dashboard"></i></span>
                    <span class="s-text">Manage Faculties</span>
                </a>
            </li>
            <li>
                <a href="{{route("facultyStudents")}}" class="waves-effect  waves-light">
                    <span class="s-icon"><i class="ti-dashboard"></i></span>
                    <span class="s-text">Faculty Students</span>
                </a>
            </li>





            <li class="menu-title">More</li>
            <li class="compact-hide hidden">
                <div id="sidebar-chart" class="chartist-animated chartist-light"></div>
            </li>
            <li class="compact-hide">
                <a href="javascript: void(0);" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="waves-effect  waves-light">
                    <span class="s-icon"><i class="fa fa-circle-o text-danger"></i></span>
                    <span class="s-text">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</div>
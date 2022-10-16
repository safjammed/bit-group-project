<!-- Sidebar -->
<div class="site-sidebar-overlay"></div>
<div class="site-sidebar">
    <a class="logo" href="/">
        <span class="l-text">{{config('app.name')}}</span>
        <span class="l-icon"></span>
    </a>
    <div class="custom-scroll custom-scroll-light">
        <ul class="sidebar-menu">
            <li class="menu-title m-t-0-5">Navigation</li>
            <li>
                <a href="/" class="waves-effect  waves-light">
                    <span class="s-icon"><i class="ti-home"></i></span>
                    <span class="s-text">Home</span>
                </a>
            </li>

            @can("view articles and pictures")
            <li>
                <a href="{{route("allSubmissions")}}" class="waves-effect  waves-light">
                    <span class="s-icon"><i class="ti-bookmark-alt"></i></span>
                    <span class="s-text">Submissions</span>
                </a>
            </li>
            @endcan
            @can("view selected articles")
            <li>
                <a href="{{route("selectedSubmissions")}}" class="waves-effect  waves-light">
                    <span class="s-icon"><i class="ti-cup"></i></span>
                    <span class="s-text">Selected Submissions</span>
                </a>
            </li>
            @endcan
            @can('modify users')
            <li class="menu-title">Management</li>
            <li>
                <a href="{{route("manageUsers")}}" class="waves-effect  waves-light">
                    <span class="s-icon"><i class=" ti-user"></i></span>
                    <span class="s-text">Users</span>
                </a>
            </li>
            @endcan
            @can("edit system data")
            <li>
                <a href="{{route("manageClosures")}}" class="waves-effect  waves-light">
                    <span class="s-icon"><i class="ti-alarm-clock"></i></span>
                    <span class="s-text">Closures</span>
                </a>
            </li>
            @endcan
            @can("modify faculty")
            <li>
                <a href="{{route("showFaculties")}}" class="waves-effect  waves-light">
                    <span class="s-icon"><i class="ti-agenda"></i></span>
                    <span class="s-text">Faculties</span>
                </a>
            </li>
            @endcan
            @can("modify faculty")
            <li>
                <a href="{{route("facultyStudents")}}" class="waves-effect  waves-light">
                    <span class="s-icon"><i class="ti-face-smile"></i></span>
                    <span class="s-text">Faculty Students</span>
                </a>
            </li>
            @endcan





            <li class="menu-title">More</li>
            @can('view report')
                <li>
                    <a href="{{route("reportView")}}" class="waves-effect  waves-light">
                        <span class="s-icon"><i class="ti-face-smile"></i></span>
                        <span class="s-text">Reports</span>
                    </a>
                </li>
            @endcan


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

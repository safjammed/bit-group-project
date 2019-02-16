<!-- Header -->
<div class="site-header">
    <nav class="navbar navbar-light">
        <ul class="nav navbar-nav">
            <li class="nav-item m-r-1 hidden-lg-up">
                <a class="nav-link collapse-button" href="#">
                    <i class="ti-menu"></i>
                </a>
            </li>
        </ul>
        <ul class="nav navbar-nav pull-xs-right">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" data-toggle="dropdown" aria-expanded="false">
                    <i class="ti-check"></i>
                    <span class="tag tag-success top">3</span>
                </a>
                <div class="dropdown-tasks dropdown-menu dropdown-menu-right animated slideInUp">
                    <div class="t-item">
                        <div class="m-b-0-5">
                            <a class="text-black" href="#">First Task</a>
                            <span class="pull-xs-right text-muted">75%</span>
                        </div>
                        <progress class="progress progress-danger progress-sm" value="75" max="100">100%</progress>
                        <span class="avatar box-32">
										<img src="img/avatars/2.jpg" alt="">
									</span>
                        <a class="text-black" href="#">John Doe</a>, <span class="text-muted">5 min ago</span>
                    </div>
                    <div class="t-item">
                        <div class="m-b-0-5">
                            <a class="text-black" href="#">Second Task</a>
                            <span class="pull-xs-right text-muted">40%</span>
                        </div>
                        <progress class="progress progress-purple progress-sm" value="40" max="100">100%</progress>
                        <span class="avatar box-32">
										<img src="img/avatars/3.jpg" alt="">
									</span>
                        <a class="text-black" href="#">John Doe</a>, <span class="text-muted">15:07</span>
                    </div>
                    <div class="t-item">
                        <div class="m-b-0-5">
                            <a class="text-black" href="#">Third Task</a>
                            <span class="pull-xs-right text-muted">100%</span>
                        </div>
                        <progress class="progress progress-warning progress-sm" value="100" max="100">100%</progress>
                        <span class="avatar box-32">
										<img src="img/avatars/4.jpg" alt="">
									</span>
                        <a class="text-black" href="#">John Doe</a>, <span class="text-muted">yesterday</span>
                    </div>
                    <div class="t-item">
                        <div class="m-b-0-5">
                            <a class="text-black" href="#">Fourth Task</a>
                            <span class="pull-xs-right text-muted">60%</span>
                        </div>
                        <progress class="progress progress-success progress-sm" value="60" max="100">100%</progress>
                        <span class="avatar box-32">
										<img src="img/avatars/5.jpg" alt="">
									</span>
                        <a class="text-black" href="#">John Doe</a>, <span class="text-muted">3 days ago</span>
                    </div>
                    <a class="t-item text-black text-xs-center" href="#">
                        <strong>View all tasks</strong>
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" data-toggle="dropdown" aria-expanded="false">
                    <i class="ti-bell"></i>
                    <span class="tag tag-danger top">12</span>
                </a>
                <div class="dropdown-messages dropdown-tasks dropdown-menu dropdown-menu-right animated slideInUp">
                    <div class="m-item">
                        <div class="mi-icon bg-info"><i class="ti-comment"></i></div>
                        <div class="mi-text"><a class="text-black" href="#">John Doe</a> <span class="text-muted">commented post</span> <a class="text-black" href="#">Lorem ipsum dolor</a></div>
                        <div class="mi-time">5 min ago</div>
                    </div>
                    <div class="m-item">
                        <div class="mi-icon bg-danger"><i class="ti-heart"></i></div>
                        <div class="mi-text"><a class="text-black" href="#">John Doe</a> <span class="text-muted">liked post</span> <a class="text-black" href="#">Lorem ipsum dolor</a></div>
                        <div class="mi-time">15:07</div>
                    </div>
                    <div class="m-item">
                        <div class="mi-icon bg-purple"><i class="ti-user"></i></div>
                        <div class="mi-text"><a class="text-black" href="#">John Doe</a> <span class="text-muted">followed</span> <a class="text-black" href="#">Kate Doe</a></div>
                        <div class="mi-time">yesterday</div>
                    </div>
                    <div class="m-item">
                        <div class="mi-icon bg-danger"><i class="ti-heart"></i></div>
                        <div class="mi-text"><a class="text-black" href="#">John Doe</a> <span class="text-muted">liked post</span> <a class="text-black" href="#">Lorem ipsum dolor</a></div>
                        <div class="mi-time">3 days ago</div>
                    </div>
                    <a class="t-item text-black text-xs-center" href="#">
                        <strong>View all notifications</strong>
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" data-toggle="dropdown" aria-expanded="false">
                    <div class="avatar box-32">
                        <img src="img/avatars/1.jpg" alt="">
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right animated flipInY">
                    <a class="dropdown-item" href="#">
                        <i class="ti-email m-r-0-5"></i> Inbox
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="ti-user m-r-0-5"></i> Profile
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="ti-settings m-r-0-5"></i> Settings
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"><i class="ti-help m-r-0-5"></i> Help</a>

                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="ti-power-off m-r-0-5"></i> Sign out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            <li class="nav-item hidden-md-up">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapse-1">
                    <i class="ti-more"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link site-sidebar-second-toggle" href="#" data-toggle="collapse">
                    <i class="ti-arrow-left"></i>
                </a>
            </li>
        </ul>
        <div class="navbar-toggleable-sm collapse" id="collapse-1">
            <div class="header-form pull-md-left m-md-r-1">
                <form>
                    <input type="text" class="form-control b-a" placeholder="Search for...">
                    <button type="submit" class="btn bg-white b-a-0">
                        <i class="ti-search"></i>
                    </button>
                </form>
            </div>
            <ul class="nav navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                        Add
                    </a>
                    <div class="dropdown-menu animated flipInY">
                        <a class="dropdown-item" href="#">
                            Link
                            <span class="tag tag-primary">3</span>
                        </a>
                        <a class="dropdown-item" href="#">Another link</a>
                        <a class="dropdown-item" href="#">
                            Something else here
                            <span class="tag tag-success">7</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Separated link</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
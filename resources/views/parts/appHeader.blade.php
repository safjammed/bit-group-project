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
                <a class="nav-link" onclick="event.preventDefault();document.getElementById('logout-form').submit();" aria-expanded="false">
                    <i class="ti-power-off px-3 py-3" style="border: 1px dashed #ccc;"></i>
                </a>
            </li>

            {{--<li class="nav-item">--}}
                {{--<a class="nav-link site-sidebar-second-toggle" href="#" data-toggle="collapse">--}}
                    {{--<i class="ti-arrow-left"></i>--}}
                {{--</a>--}}
            {{--</li>--}}
        </ul>
        <div class="navbar-toggleable-sm collapse" id="collapse-1">
            <ul class="nav navbar-nav">

                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" data-toggle="dropdown" aria-expanded="true">
                        <div class="avatar box-32">
                            <img src="/img/avatars/1.jpg" alt="">
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left animated flipInY">
                        {{--<a class="dropdown-item" href="#">--}}
                            {{--<i class="ti-email m-r-0-5"></i> Inbox--}}
                        {{--</a>--}}
                        {{--<a class="dropdown-item" href="#">--}}
                            {{--<i class="ti-user m-r-0-5"></i> Profile--}}
                        {{--</a>--}}
                        {{--<a class="dropdown-item" href="#">--}}
                            {{--<i class="ti-settings m-r-0-5"></i> Settings--}}
                        {{--</a>--}}
                        {{--<div class="dropdown-divider"></div>--}}
                        {{--<a class="dropdown-item" href="#"><i class="ti-help m-r-0-5"></i> Help</a>--}}

                        <a class="dropdown-item" href="{{route("logout")}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="ti-power-off m-r-0-5"></i> Sign out</a>
                        <form id="logout-form" action="{{route("logout")}}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                <li class="dropdown-item-text">
                    <div class="pt-3 ml-5">
                    <h6 class="blue-text">{{\Auth::user()->name}}</h6>
                    <span class="grey-text">{{(\Auth::user()->getRoleNames())[0]}}</span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
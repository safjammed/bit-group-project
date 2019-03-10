
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Contain all css and header information -->
    @include('parts.head')

    @yield('extra_css')
</head>
<body class="large-sidebar fixed-sidebar fixed-header content-appear">
<div class="wrapper">


    @include('parts.sidebar')
    @include('parts.appSidePanel')


    <!-- Template options -->
    <div class="template-options custom-scroll custom-scroll-dark">
        <div class="to-toggle"><i class="ti-settings"></i></div>
        <div class="to-content">
            <h6>Layouts</h6>
            <div class="row m-b-2 text-xs-center">
                <div class="col-xs-6 m-b-2">
                    <label>
                        <input name="compact-sidebar" type="checkbox">
                        <div class="to-icon"><i class="ti-check"></i></div>
                        <img src="img/layouts/2.png" class="img-fluid">
                    </label>
                    <div class="text-muted">Compact Sidebar</div>
                </div>
                <div class="col-xs-6 m-b-2">
                    <label>
                        <input name="fixed-header" type="checkbox" checked>
                        <div class="to-icon"><i class="ti-check"></i></div>
                        <img src="img/layouts/3.png" class="img-fluid">
                    </label>
                    <div class="text-muted">Fixed Header</div>
                </div>
                <div class="col-xs-6 m-b-2">
                    <label>
                        <input name="boxed-wrapper" type="checkbox">
                        <div class="to-icon"><i class="ti-check"></i></div>
                        <img src="img/layouts/4.png" class="img-fluid">
                    </label>
                    <div class="text-muted">Boxed Wrapper</div>
                </div>
            </div>
            <h6>Skins</h6>
            <div class="row">
                <div class="col-xs-3 m-b-2">
                    <label>
                        <input name="skin" value="skin-default" type="radio" checked>
                        <div class="to-icon"><i class="ti-check"></i></div>
                        <div class="to-skin">
                            <span class="skin-first bg-white"></span>
                            <span class="skin-second skin-dark-blue"></span>
                            <span class="skin-third bg-info"></span>
                        </div>
                    </label>
                </div>
                <div class="col-xs-3 m-b-2">
                    <label>
                        <input name="skin" value="skin-1" type="radio">
                        <div class="to-icon"><i class="ti-check"></i></div>
                        <div class="to-skin">
                            <span class="skin-first skin-dark-blue-2"></span>
                            <span class="skin-second bg-white"></span>
                            <span class="skin-third bg-danger"></span>
                        </div>
                    </label>
                </div>
                <div class="col-xs-3 m-b-2">
                    <label>
                        <input name="skin" value="skin-2" type="radio">
                        <div class="to-icon"><i class="ti-check"></i></div>
                        <div class="to-skin">
                            <span class="skin-first bg-white"></span>
                            <span class="skin-second bg-black"></span>
                            <span class="skin-third bg-success"></span>
                        </div>
                    </label>
                </div>
                <div class="col-xs-3 m-b-2">
                    <label>
                        <input name="skin" value="skin-3" type="radio">
                        <div class="to-icon"><i class="ti-check"></i></div>
                        <div class="to-skin">
                            <span class="skin-first bg-white"></span>
                            <span class="skin-second skin-grey"></span>
                            <span class="skin-third bg-purple"></span>
                        </div>
                    </label>
                </div>
                <div class="col-xs-3 m-b-2">
                    <label>
                        <input name="skin" value="skin-4" type="radio">
                        <div class="to-icon"><i class="ti-check"></i></div>
                        <div class="to-skin">
                            <span class="skin-first skin-dark-blue"></span>
                            <span class="skin-second skin-dark-blue-2"></span>
                            <span class="skin-third bg-warning"></span>
                        </div>
                    </label>
                </div>
                <div class="col-xs-3 m-b-2">
                    <label>
                        <input name="skin" value="skin-5" type="radio">
                        <div class="to-icon"><i class="ti-check"></i></div>
                        <div class="to-skin">
                            <span class="skin-first bg-primary"></span>
                            <span class="skin-second bg-white"></span>
                            <span class="skin-third bg-primary"></span>
                        </div>
                    </label>
                </div>
            </div>
        </div>
    </div>

    @include('parts.appHeader')

    <div class="site-content">
        <!-- Content -->
        <div class="content-area p-y-1">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
        <!-- Footer -->
        @include('parts.footer')

    </div>

</div>

@include('parts.javascripts')
</body>
</html>











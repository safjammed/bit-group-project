<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Contain all css and header information -->
    @include('parts.head')

    @yield('extra_css')
</head>
<body class="auth-bg">

<div class="auth">
    <div class="auth-header">
        <h1>{{config('app.name')}}</h1>
        <h6>Welcome! Sign in to access the admin panel</h6>
    </div>
    <div class="container-fluid">
        @yield('content')

    </div>
</div>
@include('parts.javascripts')
</body>
</html>

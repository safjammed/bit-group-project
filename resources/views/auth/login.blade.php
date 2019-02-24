@extends('layouts.login')

@section('content')
    <div class="row">
        <div class="col-md-4 offset-md-4">
            @if (count($errors) > 0)
                <div class="alert alert-danger ">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <div class="input-group">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                        <div class="input-group-addon"><i class="ti-email"></i></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                        <div class="input-group-addon"><i class="ti-key"></i></div>
                    </div>
                </div>
                <div class="form-group clearfix">
                    <div class="pull-xs-left">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description font-90">Remember me</span>
                        </label>
                    </div>
                    @if (Route::has('password.request'))
                        <div class="pull-xs-right">
                            <a class="text-white font-90" href="{{ route('password.request') }}">Forgot password?</a>
                        </div>
                    @endif

                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <button type="submit" class="btn btn-info btn-block label-left m-b-0-25">
                            <span class="btn-label"><i class="ti-face-smile"></i></span>
                            Sign In
                        </button>
                    </div>
                    <div class="col-xs-6">
                        <a href="{{route('register')}}" class="btn btn-primary btn-block label-left m-b-0-25">
                            <span class="btn-label"><i class="ti-write"></i></span>
                            Register
                        </a>
                    </div>
                </div>

                {{--<div class="form-group">--}}
                    {{--<button type="submit" class="btn btn-danger btn-block">Sign in</button>--}}
                    {{--<a  class="btn btn-success btn-block">Sign in</a>--}}
                {{--</div>--}}
            </form>

        </div>
    </div>
@endsection

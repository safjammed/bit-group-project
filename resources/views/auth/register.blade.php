@extends('layouts.login')

@section('content')
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group row">
                    <div class="col-md-12">
                        <input id="name" placeholder="Name"type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <input id="email" placeholder="Email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <input id="password" placeholder="Password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <input id="password-confirm" placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary w-100">
                            {{ __('Register') }}
                        </button>
                    </div>
                    <div class="col-md-6">
                        <a href="{{route('login')}}" class="btn btn-info w-100">
                            {{ __('Login Instead') }}
                        </a>
                    </div>
                </div>
            </form>
            {{--<div class="row">--}}
            {{--<div class="col-xs-6">--}}
            {{--<button type="button" class="btn bg-facebook btn-block label-left m-b-0-25">--}}
            {{--<span class="btn-label"><i class="ti-facebook"></i></span>--}}
            {{--Facebook--}}
            {{--</button>--}}
            {{--</div>--}}
            {{--<div class="col-xs-6">--}}
            {{--<button type="button" class="btn bg-twitter btn-block label-left m-b-0-25">--}}
            {{--<span class="btn-label"><i class="ti-twitter"></i></span>--}}
            {{--Twitter--}}
            {{--</button>--}}
            {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>
@endsection
@section('extra_js')
    <script>

    </script>
@endsection














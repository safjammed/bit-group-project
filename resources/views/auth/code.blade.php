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

            <form method="POST" action="{{ route('code') }}">
                @csrf
                <div class="form-group">
                    <p class="text-center">a code has been sent to your phone. please write it here</p>
                    <div class="input-group">

                        <input id="code" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="code" value="{{ old('code') }}" required autofocus placeholder="4 Digit Code">

                        @if ($errors->has('code'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                        @endif
                        <div class="input-group-addon"><i class="ti-email"></i></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <button type="submit" class="btn btn-info btn-block label-left m-b-0-25">
                            <span class="btn-label"><i class="ti-face-smile"></i></span>
                            Confirm Code
                        </button>
                    </div>
                    <div class="col-xs-6">
                        <a href="{{--route('resendCode')--}}" class="btn btn-primary btn-block label-left m-b-0-25">
                            <span class="btn-label"><i class="ti-write"></i></span>
                            Resend Code
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

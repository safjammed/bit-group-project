@extends('layouts.login')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-4 offset-md-4">

            <div class="box b-a-0">

                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif

                <div class="p-a-2 text-xs-center">
                    <h4 class="p-y-3">{{ __('Verify Your Email Address') }}</h4>
                    <p> {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }}</p>
                </div>
                    <a href="{{ route('verification.resend') }}" class="btn btn-purple btn-block text-uppercase">{{ __('click here to request another') }}</a>
                    <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn btn-danger btn-block text-uppercase">{{ __('LOGOUT') }}</a>
            </div>
        </div>
    </div>

    <form id="logout-form" action="{{route("logout")}}" method="POST" style="display: none;">
        @csrf
    </form>
@endsection

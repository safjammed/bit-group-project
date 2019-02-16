
@extends('layouts.login')

@section('content')
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

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

                <div class="form-group row mb-0">
                    <div class="col-md-6 mx-auto ">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection











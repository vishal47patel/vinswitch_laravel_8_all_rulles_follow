@extends('layouts.login')

@section('content')

<form method="POST" action="{{ route('password.update') }}">
@csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" placeholder="Enter your email" value="{{ $email ?? old('email') }}">
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Password</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" placeholder="Enter your password">

        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Confirm Password</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" placeholder="Enter your confirm email">
    </div>

    <div class="text-center d-grid">
            <button type="submit" class="btn btn-primary">
            {{ __('Reset Password') }}
            </button>
    </div>
</form>

    </div> <!-- end card-body -->
</div>
<!-- end card -->

<div class="row mt-3">
     <div class="col-12 text-center">
        <p class="text-white-50">Back to <a href="{{ route('login') }}" class="text-white ms-1"><b>Log in</b></a></p>
     </div> <!-- end col -->
</div>
<!-- end row -->

</div> <!-- end col -->
</div><!-- end row -->
</div><!-- end container -->
</div><!-- end page -->

@endsection

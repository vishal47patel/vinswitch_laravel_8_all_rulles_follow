@extends('layouts.login')

@section('content')
 <form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="mb-3">
        <label for="first_name" class="form-label">First Name</label>
        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" autocomplete="name" autofocus placeholder="Enter your first name">
    </div>

    <div class="mb-3">
        <label for="last_name" class="form-label">Last Name</label>
        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}"  autocomplete="name" autofocus placeholder="Enter your last name">
    </div>

    <div class="mb-3">
        <label for="emailaddress" class="form-label">Email address</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" placeholder="Enter your email">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <div class="input-group input-group-merge">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="Enter your password">
            <div class="input-group-text" data-password="false">
                <span class="password-eye"></span>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <div class="input-group input-group-merge">
            
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" class="form-control @error('password-confirm') is-invalid @enderror" autocomplete="new-password" placeholder="Enter your confirm password">


            <div class="input-group-text" data-password="false">
                <span class="password-eye"></span>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="checkbox-signup">
            <label class="form-check-label" for="checkbox-signup">I accept <a href="javascript: void(0);" class="text-dark">Terms and Conditions</a></label>
        </div>
    </div>
    <div class="text-center d-grid">
        <button class="btn btn-success" type="submit"> Sign Up </button>
    </div>

    <div class="row mt-3">
        <div class="col-12 text-center">
            <p class="text-white-50">Already have account?  <a href="{{ route('login') }}" class="text-white ms-1"><b>Sign In</b></a></p>
        </div> <!-- end col -->
    </div>
</form>


</div> <!-- end card-body -->
</div>
<!-- end card -->

<div class="row mt-3">
    <div class="col-12 text-center">
        <p class="text-white-50">Already have account?  <a href="{{ route('login') }}" class="text-white ms-1"><b>Sign In</b></a></p>
    </div> <!-- end col -->
</div>
<!-- end row -->

</div> <!-- end col -->
</div><!-- end row -->
</div><!-- end container -->
</div><!-- end page -->
@endsection

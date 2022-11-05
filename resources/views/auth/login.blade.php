@extends('layouts.login')

@section('content')

 <form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-3">
        <label for="emailaddress" class="form-label">Email address</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus placeholder="Enter your email">

    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <div class="input-group input-group-merge">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="current-password" placeholder="Enter your password">
            <div class="input-group-text" data-password="false">
                <span class="password-eye"></span>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
            <label class="form-check-label" for="checkbox-signin">Remember me</label>
        </div>
    </div>

    <div class="text-center d-grid">
        <button class="btn btn-primary" type="submit"> Log In </button>
    </div>

</form>

</div> <!-- end card-body -->
</div>
                     
<!-- end card -->
<div class="row mt-3">
    <div class="col-12 text-center">
        <p> <a href="{{ route('password.request') }}" class="text-white-50 ms-1">Forgot your password?</a></p>
    </div> <!-- end col -->
</div>
<!-- end row -->

</div> <!-- end col -->
</div><!-- end row -->
</div><!-- end container -->
</div><!-- end page -->             
@endsection

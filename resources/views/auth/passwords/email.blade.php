@extends('layouts.login')

@section('content')
<form method="POST" action="{{ route('password.email') }}">
@csrf

    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" placeholder="Enter your email">
         @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="text-center d-grid">
        <button class="btn btn-primary" type="submit"> Reset Password </button>
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

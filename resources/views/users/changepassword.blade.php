@extends('layouts.main')
 
@section('content')

<div class="container-fluid"><br>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <!-- header start-->
                    <div class="row with-border mb-2">
                        <div class="col-md-6">
                             <h4 class="page-title"><i class="fa fa-lock" aria-hidden="true"></i> Change Password</h4>
                        </div>
                    </div>
                    <!-- header end-->
                    @include('layouts.flash_message')
                        
                    <form action="{{ route('users.submitchangepassword') }}" method="POST" id="check_validation">
                    @csrf
                        <div class="row">
                            <div class="col-lg-6 mb-2">                                    
                                <label for="simpleinput" class="form-label">Current Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" name="current_password" id="current_password" placeholder="Current password" value="{{ old('current_password') }}" autocomplete = off >
                                </div>
                                @error('current_password')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-6 mb-2">
                                <label for="example-email" class="form-label">New Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="New password" value="{{ old('password') }}" autocomplete = off >
                                </div>
                                @error('password')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-6 mb-2">
                                <label for="example-password" class="form-label">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm password" value="" autocomplete = off >
                                </div>
                                @error('confirm_password')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit" id="submit_btn">Submit</button>
                    </form>
                        
                </div> 
            </div> 
        </div>
    </div>
</div> 
@endsection
<script src="{{ asset('js/validation.js') }}" defer></script>

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
                             <h4 class="page-title"><i class="fa fa-user" aria-hidden="true"></i> User Profile</h4>
                        </div>
                    </div>
                    <!-- header end-->
                        
                    <form action="{{ route('users.updateprofile',$user->id) }}" method="POST" id="check_validation">
                    @csrf
                        <div class="row">

                            <div class="col-lg-6 mb-2">
                                <label for="example-email" class="form-label">First Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter First Name" value="{{ $user->firstname }}" autocomplete = off >
                                </div>
                                @error('firstname')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-6 mb-2">
                                <label for="example-password" class="form-label">Last Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter Last Name" value="{{ $user->lastname }}" autocomplete = off>
                                </div>
                                @error('lastname')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-6 mb-2">
                                <label for="example-password" class="form-label">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="phoneno" id="phone" placeholder="Enter Phone Number" value="{{ $user->phoneno }}" autocomplete = off>
                                </div>
                                @error('phoneno')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-6 mb-2">
                                <label for="example-password" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email Address" value="{{ $user->email }}" autocomplete = off>
                                </div>
                                @error('email')<p class="validation_error">{{ $message }}</p> @enderror
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

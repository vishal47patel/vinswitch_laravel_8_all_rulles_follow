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
                             <h4 class="page-title"><i class="fa fa-user" aria-hidden="true"></i> Add User Detail</h4>
                        </div>
                         <div class="col-md-6 pull-right mb-1">
                            <a class="btn btn-primary" href="{{ route('users.index') }}"><i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <!-- header end-->
                        
                    <form action="{{ route('users.store') }}" method="POST" id="check_validation">
                    @csrf
                        <div class="row">
                           
                            <div class="col-lg-6 mb-2">
                                <label for="example-email" class="form-label">First Name<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter First Name" value="{{ old('firstname') }}" autocomplete = off >
                                </div>
                                @error('firstname')<p class="validation_error">{{ $message }} </p>@enderror
                            </div>

                            <div class="col-lg-6 mb-2">
                                <label for="example-password" class="form-label">Last Name<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter Last Name" value="{{ old('lastname') }}" autocomplete = off>
                                </div>
                                @error('lastname')<p class="validation_error">{{ $message }} </p>@enderror
                            </div>

                            <div class="col-lg-6 mb-2">
                                <label for="example-password" class="form-label">Phone Number<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="phoneno" id="phoneno" placeholder="Enter Phone Number" value="{{ old('phoneno') }}" autocomplete = off>
                                </div>
                                @error('phoneno')<p class="validation_error">{{ $message }} </p>@enderror
                            </div>

                            <div class="col-lg-6 mb-2">
                                <label for="example-password" class="form-label">Email<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email Address" value="{{ old('email') }}" autocomplete = off>
                                </div>
                                @error('email')<p class="validation_error">{{ $message }} </p>@enderror
                            </div>

                            <div class="col-lg-6 mb-2">
                                <label for="example-email" class="form-label">Username<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username" value="{{ old('username') }}" autocomplete = off >
                                </div>
                                @error('username')<p class="validation_error">{{ $message }} </p>@enderror
                            </div>

                            <div class="col-lg-6 mb-2">
                                <label for="example-password" class="form-label">Password<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" value="{{ old('password') }}" autocomplete = off>
                                </div>
                                @error('password')<p class="validation_error">{{ $message }} </p>@enderror
                            </div>

                            <div class="col-lg-6 mb-2">
                                <label for="example-password" class="form-label">Confirm Password<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Enter Confirm Password" value="{{ old('confirm_password') }}" autocomplete = off>
                                </div>
                                @error('confirm_password')<p class="validation_error">{{ $message }} </p>@enderror
                            </div>

                            <div class="col-lg-6 mb-2">                                    
                                <label for="status" class="form-label">Status<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-adjust" aria-hidden="true"></i></span>
                                    <select class="form-control" name="status"  title="Status">
                                      <option value="ENABLED" @if('status' == 'ENABLED') selected @endif>ENABLED</option>
                                      <option value="DISNABLED" @if('status' == 'DISNABLED') selected @endif>DISNABLED</option>
                                    </select>
                                </div>
                                @error('status')<p class="validation_error">{{ $message }} </p>@enderror
                            </div>

                            <div class="col-lg-6 mb-2">                                    
                                <label for="role" class="form-label">Role<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-user-circle" aria-hidden="true"></i></span>
                                    <select class="form-control"  name="role_id"  title="Role" id="role_id" >
                                    <option disabled="" selected>Select Role</option>
                                    @foreach ($roles as $role)
                                    <option value="{{$role->id}}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{$role->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                @error('role_id')<p class="validation_error">{{ $message }} </p>@enderror
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



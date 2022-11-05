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
                             <h4 class="page-title"><i class="fa fa-user" aria-hidden="true"></i> Edit User Detail</h4>
                        </div>
                         <div class="col-md-6 pull-right mb-1">
                            <a class="btn btn-primary" href="{{ route('users.index') }}"><i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <!-- header end-->
                        
                    <form action="{{ route('users.update',$user->id) }}" method="POST" id="check_validation">
                    @csrf
                        <div class="row">
                            

                            <div class="col-lg-6 mb-2">
                                <label for="example-email" class="form-label">First Name<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter First Name" value="{{ $user->firstname }}" autocomplete = off >
                                </div>
                                @error('firstname')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-6 mb-2">
                                <label for="example-password" class="form-label">Last Name<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter Last Name" value="{{ $user->lastname }}" autocomplete = off>
                                </div>
                                @error('lastname')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-6 mb-2">
                                <label for="example-password" class="form-label">Phone Number<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="phoneno" id="phoneno" placeholder="Enter Phone Number" value="{{ $user->phoneno }}" autocomplete = off>
                                </div>
                                @error('phoneno')<p class="validation_error">{{ $message }} </p>@enderror
                            </div>

                            <div class="col-lg-6 mb-2">
                                <label for="example-password" class="form-label">Email<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email Address" value="{{ $user->email }}" autocomplete = off>
                                </div>
                                @error('email')<p class="validation_error">{{ $message }} </p>@enderror
                            </div>

                            <div class="col-lg-6 mb-2">
                                <label for="example-email" class="form-label">Username<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username" value="{{ $user->username }}" autocomplete = off >
                                </div>
                                @error('username')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-6 mb-2">                                    
                                <label for="status" class="form-label">Status<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-adjust" aria-hidden="true"></i></span>
                                    <select class="form-control" name="status"  title="Status">
                                      <option value="ENABLED" @if($user->status == 'ENABLED') selected @endif>ENABLED</option>
                                      <option value="DISNABLED" @if($user->status == 'DISNABLED') selected @endif>DISNABLED</option>
                                    </select>
                                </div>
                                @error('status')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-6 mb-2">                                    
                                <label for="simpleinput" class="form-label">Role<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-user-circle" aria-hidden="true"></i></span>
                                    <select class="form-control"  name="role_id"  title="Role" id="role_id">
                                        <option disabled="">Select Role</option>
                                        @foreach ($roles as $role)
                                        <option value="{{$role->id}}" @if( $user->role_id == $role->id) selected @endif>{{$role->name}}</option>
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

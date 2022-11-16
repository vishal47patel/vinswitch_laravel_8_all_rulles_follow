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
                             <h4 class="page-title"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Reset Password <small>(<?php echo 'Account Number: '. $tenant->account_code; ?>)</small></h4>
                        </div>
                        <div class="col-md-6 pull-right mb-1">
                            <a class="btn-sm btn-primary" href="{{ route('tenant.index') }}"><i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <!-- header end-->
                        
                    <form action="{{ route('tenant.tenantresetpassword',$tenant->id) }}" method="POST" id="check_validation">
                    @csrf
                        <div class="row">
                            <div class="col-lg-4 mb-2">                                    
                                <label for="simpleinput" class="form-label">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Current password" value="{{ $user->username }}" autocomplete = off readonly>
                                </div>
                                @error('username')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-4 mb-2">
                                <label for="example-email" class="form-label">New Password<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="New password" value="{{ old('password') }}" autocomplete = off >
                                </div>
                                @error('password')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-4 mb-2">
                                <label for="example-password" class="form-label">Confirm Password<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
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

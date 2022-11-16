@extends('layouts.main')
@section('content')
<div class="container-fluid"><br>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <!-- header start-->
                    <div class="row with-border mb-2">
                        <div class="col-md-6">
                             <h4 class="page-title"><i class="fa fa-users" aria-hidden="true"></i> Add Customer</h4>
                        </div>
                    </div>
                    <!-- header end-->

                    <form action="{{ route('tenant.accountstore') }}" method="POST" id="check_validation" class="parsley-examples">
                    @csrf
                     <div id="basicwizard">

                        <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-3">
                        <li class="nav-item">
                            <a href="#" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2" id="customer">
                                <i class="mdi mdi-account-circle me-1"></i>
                                <span class="d-none d-sm-inline">Customer Information</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2 active" id="account">
                                <i class="mdi mdi-face-profile me-1" ></i>
                                <span class="d-none d-sm-inline">Account Credential</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2" id="billing">
                                <i class="mdi mdi-checkbox-marked-circle-outline me-1"></i>
                                <span class="d-none d-sm-inline">Billing Information</span>
                            </a>
                        </li>
                        </ul>
                                            
                        <div class="tab-content b-0 mb-0 pt-0">
    
                            <!-- Account Information start -->            
                            <div>
                                <div class="row">
                               
                                <div class="col-lg-6 mb-2">
                                    <label for="example-email" class="form-label">First Name<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><b>F</b></span>
                                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter First Name" value="{{ $customer['first_name'] }}" autocomplete = off >
                                    </div>
                                    @error('first_name')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-6 mb-2">
                                    <label for="example-password" class="form-label">Last Name<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><b>L</b></span>
                                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter Last Name" value="{{ $customer['last_name'] }}" autocomplete = off>
                                    </div>
                                    @error('last_name')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-6 mb-2">
                                    <label for="example-password" class="form-label">Email<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email Address" value="{{ $customer['email'] }}" autocomplete = off>
                                    </div>
                                    @error('email')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-6 mb-2">
                                    <label for="example-password" class="form-label">Phone Number<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="Enter Phone Number" value="{{ $customer['phone_number'] }}" autocomplete = off>
                                    </div>
                                    @error('phone_number')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-6 mb-2">
                                    <label for="example-email" class="form-label">Username<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-bank" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Enter Company Name" value="{{ !empty($user['username']) ? $user['username'] : old('username') }}" autocomplete = off >
                                    </div>
                                    @error('username')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-6 mb-2">
                                    <label for="example-password" class="form-label">Password<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-home" aria-hidden="true"></i></span>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter Address" value="{{ !empty($user['password']) ? $user['password'] : old('password') }}" autocomplete = off>
                                    </div>
                                    @error('password')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>
                                </div>

                            </div><br>
                            <!-- Account Information end  -->

                            <ul class="list-inline mb-0 wizard">
                                <li class="previous list-inline-item">
                                    <a href="{{ URL::to('/tenants/customer-info?view=tenant.customer_create') }}" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                                </li>
                                <li class="next list-inline-item float-end">
                                   <button class="btn btn-primary" type="submit" id="submit_btn"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                                </li>
                            </ul>

                        </div> 
                    </div>
                </form>
            </div>
        </div> 
    </div> 
</div> 
<script type="text/javascript">
$(document).ready(function() {
  $('#billing').prop("disabled", true);
  $('#customer').prop("disabled", true);
  $("#customer").removeClass('active');
  $('#account').addClass('active');
});
</script>
@endsection
<script src="{{ asset('js/validation.js') }}" defer></script>




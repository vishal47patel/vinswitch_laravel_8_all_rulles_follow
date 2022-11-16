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
                             <h4 class="page-title"><i class="fa fa-users" aria-hidden="true"></i>  Update Customer<small> (<?php echo 'Account Number: '. $tenant->account_number; ?>)</small></h4>
                        </div>
                        <div class="col-md-6 pull-right mb-1">
                            <a class="btn-sm btn-primary" href="{{ route('tenant.index') }}"><i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <!-- header end-->

                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="#account-2" data-bs-toggle="tab" data-toggle="tab" class="nav-link" id="tenant">
                                <i class="mdi mdi-account-circle me-1"></i>
                                <span class="d-none d-sm-inline">Personal Information</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#profile-2" data-bs-toggle="tab" data-toggle="tab" class="nav-link" id="billplan">
                                <i class="mdi mdi-face-profile me-1"></i>
                                <span class="d-none d-sm-inline">Bill Plan</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#finish-2" data-bs-toggle="tab" data-toggle="tab" class="nav-link" id="mrc">
                                <i class="mdi mdi-checkbox-marked-circle-outline me-1"></i>
                                <span class="d-none d-sm-inline">MRC</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#port-2" data-bs-toggle="tab" data-toggle="tab" class="nav-link" id="port">
                                <i class="mdi mdi-checkbox-marked-circle-outline me-1"></i>
                                <span class="d-none d-sm-inline">Port History</span>
                            </a>
                        </li>
                        <li class="float-right">
                            <span class="btn bg-primary" style="color: #ffffff;"> Account Type: {{$tenant_finance->billplan_method}}</span>
                        </li>

                    </ul><br>

                                            
                    <div class="tab-content b-0 mb-0 pt-0">
                                                                
                        <!-- Customer Information start -->
                        <form action="{{ route('tenant.update',$tenant->id) }}" method="POST" id="check_validation" class="parsley-examples">
                        @csrf            
                        <div class="tab-pane" id="account-2">
                            <div class="row">
                               
                                <div class="col-lg-6 mb-2">
                                    <label for="example-email" class="form-label">First Name<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><b>F</b></span>
                                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter First Name" value="{{ $tenant->first_name }}" autocomplete = off >
                                    </div>
                                    @error('first_name')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-6 mb-2">
                                    <label for="example-password" class="form-label">Last Name<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><b>L</b></span>
                                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter Last Name" value="{{ $tenant->last_name }}" autocomplete = off>
                                    </div>
                                    @error('last_name')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-6 mb-2">
                                    <label for="example-password" class="form-label">Email<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email Address" value="{{ $tenant->email }}" autocomplete = off>
                                    </div>
                                    @error('email')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-6 mb-2">
                                    <label for="example-password" class="form-label">Phone Number<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="Enter Phone Number" value="{{ $tenant->phone_number }}" autocomplete = off>
                                    </div>
                                    @error('phone_number')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-6 mb-2">
                                    <label for="example-email" class="form-label">Company Name<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-bank" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Enter Company Name" value="{{ $tenant->company_name }}" autocomplete = off >
                                    </div>
                                    @error('company_name')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-6 mb-2">
                                    <label for="example-password" class="form-label">Address<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-home" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address" value="{{ $tenant->address }}" autocomplete = off>
                                    </div>
                                    @error('address')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-4 mb-2">
                                    <label for="example-password" class="form-label">Country<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-map" aria-hidden="true"></i></span>
                                         <input type="text" class="form-control" name="country" id="country" placeholder="Enter country" value="USA" autocomplete = off readonly>
                                    </div>
                                    @error('country')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-4 mb-2">                                    
                                    <label for="status" class="form-label">State<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                         <input type="text" class="form-control" name="country" id="country" placeholder="Enter country" value="USA" autocomplete = off readonly>
                                        
                                    </div>
                                    @error('state')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-4 mb-2">
                                    <label for="example-password" class="form-label">City<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-map-signs" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="city" id="city" placeholder="Enter City" value="{{ $tenant->city }}" autocomplete = off>
                                    </div>
                                    @error('city')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-4 mb-2">
                                    <label for="example-password" class="form-label">Zipcode<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-qrcode" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="postal_code" id="postal_code" placeholder="Enter Zipcode" value="{{ $tenant->postal_code }}" autocomplete = off>
                                    </div>
                                    @error('postal_code')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-4 mb-2">
                                    <label for="example-password" class="form-label">Join Date<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-calendar-check" aria-hidden="true"></i></span>
                                        <input class="form-control" id="payment_date" type="date" name="payment_date" value="{{ date('Y-m-d') }}">
                                    </div>
                                    @error('postal_code')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-4 mb-2">
                                    <label for="example-password" class="form-label">Balance<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-qrcode" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="postal_code" id="postal_code" placeholder="Enter Zipcode" value="{{ $tenant->postal_code }}" autocomplete = off>
                                    </div>
                                    @error('postal_code')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                            </div>
                            <button class="btn btn-primary" type="submit" id="submit_btn" name="agent_btn">Update</button>

                        </form>
                        <!-- Customer Information end  -->
                    </div>
                            

                        <!-- Billing Information start  -->

                        <div class="tab-pane" id="profile-2">
                            <h4 style="float:left;">
                            @if (Auth::user()->role == 'ADMIN') 
                            <button type="button" class="btn btn-primary btn-sm" onclick="changeBillplan({{$tenant->id}},{{ $billplan->type;}});" title="Change Billplan">Change Plan</button>
                            @endif

                            </h4> &nbsp;
                            <h5 style="float:right;">
                                <b>Invoice Generated Date: </b>{{$tenant_finance->invoice_generate_date}}
                                <br>
                                <b>Bill Period :</b> {{ date('Y-m-d', strtotime($tenant_finance->invoice_start_date)); }} to {{date('Y-m-d', strtotime($tenant_finance->invoice_end_date))}}
                            </h5>

                            <div class="box-body no-padding" style="margin-top:4em;">
                                <div class="mailbox-controls">
                                <h4 class="text-center">
                                    <span class="box-title">Termination Bill Plan :</span> <b> {{ $billplan->name}} </b>
                                </h4>
                                </div>
    
                                <div class="table-responsive mailbox-messages tbl_class">
                                    <table class="table table-bordered table-striped" id="yw0">
                                    <tbody>
                                    <tr class="odd"><th class="terminalbill_table">Type</th><td>{{ $billplan->type }}</td></tr>
                                    <tr class="even"><th class="terminalbill_table">SIP Account Price</th><td>{{ "$" .$billplan->sip_account_price }}</td></tr>
                                    <tr class="odd"><th class="terminalbill_table">End Point Price</th><td>{{ "$" .$billplan->end_point_price }}</td></tr>
                                    <tr class="even"><th class="terminalbill_table">Outbound SMS Price</th><td>{{ "$" .$billplan->outbound_sms_price }}</td></tr>
                                    <tr class="odd"><th class="terminalbill_table">Monthly Payment</th><td>{{ "$" .$billplan->monthly_payment }}</td></tr>
                                    <tr class="even"><th class="terminalbill_table">Per Channel Price</th><td>{{ "$" .$billplan->per_channel_price }}</td></tr>
                                    <tr class="odd"><th class="terminalbill_table">Monthly Minutes</th><td>{{ App\Libraries\General::calculateSec2Min($billplan->monthly_mins) }}</td></tr>
                                    </tbody>
                                    </table>    
                                </div>

                                <div class="mailbox-controls">
                                <h4 class="text-center">
                                    <span class="box-title">Origination Bill Plan :</span> <b> {{ $billplan->name}} </b>
                                </h4>
                                </div>

                                <div class="mailbox-controls">
                                    <h4 class="pull-left">
                                        <span class="box-title">Service Type</span> <b></b>
                                    </h4>
                                </div>
    
                                <div class="table-responsive mailbox-messages">
                                    <table class="table table-bordered table-striped" id="yw0">
                                    <tbody>
                                    <tr class="odd"><th>Type</th><td>{{ $billplan->type }}</td></tr>
                                    <tr class="even"><th>SIP Account Price</th><td>{{ "$" .$billplan->sip_account_price }}</td></tr>
                                    <tr class="odd"><th>End Point Price</th><td>{{ "$" .$billplan->end_point_price }}</td></tr>
                                    <tr class="even"><th>Outbound SMS Price</th><td>{{ "$" .$billplan->outbound_sms_price }}</td></tr>
                                    <tr class="odd"><th>Monthly Payment</th><td>{{ "$" .$billplan->monthly_payment }}</td></tr>
                                    <tr class="even"><th>Per Channel Price</th><td>{{ "$" .$billplan->per_channel_price }}</td></tr>
                                    <tr class="odd"><th>Monthly Minutes</th><td>{{ App\Libraries\General::calculateSec2Min($billplan->monthly_mins) }}</td></tr>
                                    </tbody>
                                    </table>    
                                </div>
                            </div>
                          
                         
                        </div><br>
                        <!-- Billing Information end  -->

                        <!-- Billing Information start  -->

                        <div class="tab-pane" id="port-2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-1" style="float: right;">
                                 
                                    </div>
                                </div>
                            </div> <!-- end row -->
                        </div><br>
                        <!-- Billing Information end  -->
                     

                        <div id="account_tab">
                            <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a href="" data-bs-toggle="tab" data-toggle="tab" class="nav-link active" id="tenant">
                                    <i class="mdi mdi-account-circle me-1"></i>
                                    <span class="d-none d-sm-inline"> Account Credential</span>
                                </a>
                            </li>
                            </ul><br>

                        <!-- Account Information start  -->
                        <div class="tab-pane" id="account-2">
                            <form action="{{ route('tenant.account_update',$tenant->id) }}" method="POST" id="check_validation" class="parsley-examples">
                            @csrf 
                            <div class="row">
                               
                                <div class="col-lg-6 mb-2">
                                    <label for="example-email" class="form-label">First Name<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><b>F</b></span>
                                        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter First Name" value="{{ $user->firstname }}" autocomplete = off >
                                    </div>
                                    @error('firstname')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-6 mb-2">
                                    <label for="example-password" class="form-label">Last Name<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><b>L</b></span>
                                        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter Last Name" value="{{ $user->lastname }}" autocomplete = off>
                                    </div>
                                    @error('lastname')<p class="validation_error">{{ $message }} </p>@enderror
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
                                    <label for="example-password" class="form-label">Phone Number<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="phoneno" id="phoneno" placeholder="Enter Phone Number" value="{{ $user->phoneno }}" autocomplete = off>
                                    </div>
                                    @error('phoneno')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>
 
                            </div>
                            <button class="btn btn-primary" type="submit" id="submit_btn">Update</button>
                            </form>
                        </div>
                        <!-- Account Information end  -->
                    </div>
                </div>
            </div> 
        </div> 
    </div> 
</div>

<script type="text/javascript">
$(document).ready(function() {
$("#tenant").click(function(){
    $("#account-2").show();
    $("#profile-tab-2").hide();
    $("#finish-2").hide();
    $("#port-2").hide();
    $("#account_tab").show();
});
$("#billplan").click(function(){
    $("#account-2").hide();
    $("#profile-tab-2").show();
    $("#finish-2").hide();
    $("#port-2").hide();
    $("#account_tab").hide();
});
$("#mrc").click(function(){
    $("#account-2").hide();
    $("#profile-tab-2").hide();
    $("#finish-2").show();
    $("#port-2").hide();
});  
$("#port").click(function(){
    $("#account-2").hide();
    $("#profile-tab-2").hide();
    $("#finish-2").hide();
    $("#port-2").show();
}); 
});
</script>

@endsection
<script src="{{ asset('js/validation.js') }}" defer></script>



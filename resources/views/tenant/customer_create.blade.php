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

                    <form action="{{route('tenant.store')}}" method="POST" id="check_validation" class="parsley-examples">
                    @csrf
                     <div id="basicwizard">

                        <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-3">
                        <li class="nav-item" id="customer">
                            <a href="#" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2 active">
                                <i class="mdi mdi-account-circle me-1"></i>
                                <span class="d-none d-sm-inline">Customer Information</span>
                            </a>
                        </li>
                        <li class="nav-item" >
                            <a href="#" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2" id="account">
                                <i class="mdi mdi-face-profile me-1"></i>
                                <span class="d-none d-sm-inline">Account Credential</span>
                            </a>
                        </li>
                        <li class="nav-item" >
                            <a href="#" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2" id="billing">
                                <i class="mdi mdi-checkbox-marked-circle-outline me-1"></i>
                                <span class="d-none d-sm-inline">Billing Information</span>
                            </a>
                        </li>
                        </ul>
                                            
                        <div class="tab-content b-0 mb-0 pt-0">
    
                            <!-- Customer Information start -->            
                            <div>
                                <div class="row">
                               
                                <div class="col-lg-6 mb-2">
                                    <label for="example-email" class="form-label">First Name<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><b>F</b></span>
                                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter First Name" value="{{ !empty($customer['first_name']) ? $customer['first_name'] : old('first_name') }}" autocomplete = off >
                                    </div>
                                    @error('first_name')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-6 mb-2">
                                    <label for="example-password" class="form-label">Last Name<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><b>L</b></span>
                                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter Last Name" value="{{ !empty($customer['last_name']) ? $customer['last_name'] : old('last_name') }}" autocomplete = off>
                                    </div>
                                    @error('last_name')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-4 mb-2">
                                    <label for="example-password" class="form-label">Email<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email Address" value="{{ !empty($customer['email']) ? $customer['email'] : old('email') }}" autocomplete = off>
                                    </div>
                                    @error('email')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-4 mb-2">
                                    <label for="example-password" class="form-label">Phone Number<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="Enter Phone Number" value="{{ !empty($customer['phone_number']) ? $customer['phone_number'] : old('phone_number') }}" autocomplete = off>
                                    </div>
                                    @error('phone_number')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-4 mb-2">
                                    <label for="example-email" class="form-label">Company Name<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-bank" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Enter Company Name" value="{{ !empty($customer['company_name']) ? $customer['company_name'] : old('company_name') }}" autocomplete = off >
                                    </div>
                                    @error('company_name')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-12 mb-2">
                                    <label for="example-password" class="form-label">Address<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-home" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address" value="{{ !empty($customer['address']) ? $customer['address'] : old('address') }}" autocomplete = off>
                                    </div>
                                    @error('address')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-6 mb-2">
                                    <label for="example-password" class="form-label">Country<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-map" aria-hidden="true"></i></span>
                                        <select class="form-control" name="country"  title="Country" id="country">
                                        <option disabled="" selected>Select Country</option>
                                        @foreach ($countries as $country)
                                        <option value="{{$country['ID']}}" {{ !empty($customer['country']) ? $customer['country'] : old('country') == $country['ID'] ? 'selected' : '' }}>{{$country['country']}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    @error('country')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-6 mb-2">                                    
                                    <label for="status" class="form-label">State<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                        <select class="form-control" name="state"  title="State" id="state">
                                            <option value="">Select State</option>
                                        </select>
                                    </div>
                                    @error('state')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-6 mb-2">
                                    <label for="example-password" class="form-label">City<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-map-signs" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="city" id="city" placeholder="Enter City" value="{{ !empty($customer['city']) ? $customer['city'] : old('city') }}" autocomplete = off>
                                    </div>
                                    @error('city')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-6 mb-2">
                                    <label for="example-password" class="form-label">Zipcode<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-qrcode" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="postal_code" id="postal_code" placeholder="Enter Zipcode" value="{{ !empty($customer['postal_code']) ? $customer['postal_code'] : old('postal_code') }}" autocomplete = off>
                                    </div>
                                    @error('postal_code')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                </div>

                            </div><br>
                            <!-- Customer Information end  -->

                            <ul class="list-inline mb-0 wizard">
                                <button class="btn btn-primary" type="submit" id="submit_btn"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>
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
  $('#account').prop("disabled", true);
  $('#billing').prop("disabled", true);

  $('#country').on('change', function () {
    var idCountry = this.value;
    $("#state").html('');
    $.ajax({
        url: "{{ route('tenant.fetchstate') }}",
        type: "POST",
        data: {
            country_id: idCountry,
            _token: '{{csrf_token()}}'
        },
        dataType: 'json',
        success: function (result) {
            $('#state').html('<option value="">Select State</option>');
            $.each(result.states, function (key, value) {
            $("#state").append('<option value="' + value.state_id + '">' + value.states + '</option>');
            });
        }
    });
  });
});
            
</script>
@endsection
<script src="{{ asset('js/validation.js') }}" defer></script>




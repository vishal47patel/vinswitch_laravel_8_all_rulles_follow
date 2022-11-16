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

                    <form action="{{ route('tenant.billstore') }}" method="POST" id="check_validation" class="parsley-examples">
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
                            <a href="#" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2 " id="account">
                                <i class="mdi mdi-face-profile me-1" ></i>
                                <span class="d-none d-sm-inline">Account Credential</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2 active" id="billing">
                                <i class="mdi mdi-checkbox-marked-circle-outline me-1"></i>
                                <span class="d-none d-sm-inline">Billing Information</span>
                            </a>
                        </li>
                        </ul>
                                            
                        <div class="tab-content b-0 mb-0 pt-0">
    
                            <!-- Billing Information start -->            
                            <div>
                                <div class="row">
                               
                                <div class="col-lg-3 mb-2">
                                    <label for="example-email" class="form-label">Bill Plan Type<span class="text-red"> *</span></label>
                                     <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-map" aria-hidden="true"></i></span>
                                        <select class="form-control" name="billplan_method"  id="billplan_method">
                                        <option disabled="" selected>Select Method</option>
                                        <option value="POSTPAID" {{ old('billplan_method') == 'POSTPAID' ?  'selected' : '' }}>POSTPAID</option>
                                        <option value="PREPAID" {{ old('billplan_method') == 'PREPAID' ? 'selected' : ''}}>PREPAID</option>
                                        </select>
                                    </div>
                                    @error('billplan_method')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-3 mb-2">
                                    <label for="example-email" class="form-label">Origination Bill Plan<span class="text-red"> *</span></label>
                                     <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-adjust" aria-hidden="true"></i></span>
                                        <select class="form-control" name="origination_bill_plan_id"  id="origination_bill_plan_id">
                                        <option option value="">Select Origination Bill Plan</option>                                
                                        </select>
                                    </div>
                                    @error('origination_bill_plan_id')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-3 mb-2">
                                    <label for="example-password" class="form-label">Termination Bill Plan<span class="text-red"> *</span></label>
                                     <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-bars" aria-hidden="true"></i></span>
                                        <select class="form-control" name="bill_plan_id" id="bill_plan_id">
                                         <option option value="">Select Bill Plan</option>                                      
                                        </select>
                                    </div>
                                    @error('bill_plan_id')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-3 mb-2" id="credit_limit_display" style="display: none;">
                                    <label for="example-email" class="form-label">Credit Limit<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="credit_limit" id="credit_limit" placeholder="Credit Limit" value="{{ !empty($customer['company_name']) ? $customer['company_name'] : old('company_name','50.00') }}" autocomplete = off >
                                    </div>
                                    @error('credit_limit')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                </div>
                                <div class="row">

                                <div class="col-lg-3 mb-2">
                                    <label for="example-password" class="form-label">Taxation</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                                        <select class="form-control" name="taxation" id="taxation">
                                        <option disabled="" selected>Select Taxation</option>
                                        
                                       
                                        </select>
                                    </div>
                                    @error('taxation')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-3 mb-2">                                    
                                    <label for="status" class="form-label">Call Per Seconds<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-clock" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="call_per_seconds" id="call_per_seconds" placeholder="Call Per Seconds" value="{{ !empty($customer['company_name']) ? $customer['company_name'] : old('company_name',50) }}" autocomplete = off >
                                       
                                    </div>
                                    @error('call_per_seconds')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-3 mb-2">                                    
                                    <label for="status" class="form-label">Concurrent Call</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="concurrent_call" id="concurrent_call" placeholder="Concurrent Call" value="{{ !empty($customer['company_name']) ? $customer['company_name'] : old('company_name',0) }}" autocomplete = off >
                                       
                                    </div>
                                    @error('concurrent_call')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-3 mb-2">                                    
                                    <label for="status" class="form-label">Port</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-code-fork" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="port" id="port" placeholder="Port" value="{{ !empty($customer['company_name']) ? $customer['company_name'] : old('company_name',0) }}" autocomplete = off >
                                       
                                    </div>
                                    @error('port')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                
                            </div>
                            </div><br>
                            <!-- Billing Information end  -->

                            <ul class="list-inline mb-0 wizard">
                                <li class="previous list-inline-item">
                                    <a href="{{ URL::to('/tenants/customer-info?view=tenant.account_create') }}" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                                </li>
                                <button class="btn btn-primary btn-sm" type="submit" id="submit_btn">Add</button>
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

function checkplan2(value) {
    if (value == 'POSTPAID') {
        document.getElementById('credit_limit_display').style.display = 'block';
    }
    if (value == 'PREPAID') {
        document.getElementById('credit_limit_display').style.display = 'none';
    }
}


  $('#billplan_method').on('change', function () {
    checkplan2(this.value);
    var type = this.value;
    $.ajax({
        url: "{{ route('tenant.loadbillplan') }}",
        type: "GET",
        data: {
             type: type,
            _token: '{{csrf_token()}}'
        },
        dataType: 'json',
        success: function (result) {
            $('#origination_bill_plan_id').html('<option value="">Select Origination Bill Plan</option>');
            $.each(result.origination_billplan, function (key, value) {
                $("#origination_bill_plan_id").append('<option value="' + value.id + '">' + value.bill_plan_name + '</option>');
            });
            $('#bill_plan_id').html('<option value="">Select Bill Plan</option>');
            $.each(result.billplan, function (key, value) {
                $("#bill_plan_id").append('<option value="' + value.id + '">' + value.name + '</option>');
            });
        }
    });
  });
});

</script>
@endsection
<script src="{{ asset('js/validation.js') }}" defer></script>




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
                             <h4 class="page-title"><i class="fa fa-users" aria-hidden="true"></i>  Update Agent<small> (<?php echo 'Account Number: '. $agent->account_code; ?>)</small></h4>
                        </div>
                        <div class="col-md-6 pull-right mb-1">
                            <a class="btn-sm btn-primary" href="{{ route('agent.index') }}"><i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <!-- header end-->

                        <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="#account-2" data-bs-toggle="tab" data-toggle="tab" class="nav-link" id="agent">
                                <i class="mdi mdi-account-circle me-1"></i>
                                <span class="d-none d-sm-inline">Agent Personal Information</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#profile-tab-2" data-bs-toggle="tab" data-toggle="tab" class="nav-link" id="account">
                                <i class="mdi mdi-face-profile me-1"></i>
                                <span class="d-none d-sm-inline">Account Credential</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#finish-2" data-bs-toggle="tab" data-toggle="tab" class="nav-link" id="billing">
                                <i class="mdi mdi-checkbox-marked-circle-outline me-1"></i>
                                <span class="d-none d-sm-inline">Billing Information</span>
                            </a>
                        </li>
                        </ul><br>
                                            
                        <div class="tab-content b-0 mb-0 pt-0">
                                                                
                            <!-- Customer Information start -->
                            <form action="{{ route('agent.update',$agent->id) }}" method="POST" id="check_validation" class="parsley-examples">
                            @csrf            
                            <div class="tab-pane" id="account-2">
                                <div class="row">
                               
                                <div class="col-lg-6 mb-2">
                                    <label for="example-email" class="form-label">First Name<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><b>F</b></span>
                                        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter First Name" value="{{ $agent->firstname }}" autocomplete = off >
                                    </div>
                                    @error('firstname')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-6 mb-2">
                                    <label for="example-password" class="form-label">Last Name<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><b>L</b></span>
                                        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter Last Name" value="{{ $agent->lastname }}" autocomplete = off>
                                    </div>
                                    @error('lastname')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-6 mb-2">
                                    <label for="example-password" class="form-label">Email<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email Address" value="{{ $agent->email }}" autocomplete = off>
                                    </div>
                                    @error('email')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-6 mb-2">
                                    <label for="example-password" class="form-label">Phone Number<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="contact_no" id="contact_no" placeholder="Enter Phone Number" value="{{ $agent->contact_no }}" autocomplete = off>
                                    </div>
                                    @error('contact_no')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-6 mb-2">
                                    <label for="example-email" class="form-label">Company Name<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-bank" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Enter Company Name" value="{{ $agent->company_name }}" autocomplete = off >
                                    </div>
                                    @error('company_name')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-6 mb-2">
                                    <label for="example-password" class="form-label">Address<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-home" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address" value="{{ $agent->address }}" autocomplete = off>
                                    </div>
                                    @error('address')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-6 mb-2">
                                    <label for="example-password" class="form-label">Country<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-map" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="country" id="country" placeholder="Enter country" value="USA" autocomplete = off readonly>
                                    </div>
                                    @error('country')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-6 mb-2">                                    
                                    <label for="status" class="form-label">State<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                        <select class="form-control" name="state"  title="State">
                                         @foreach ($states as $state)
                                            <option value="{{$state['ID']}}" @if( $state['ID'] == $agent->state) selected @endif>{{$state['states']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('state')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-6 mb-2">
                                    <label for="example-password" class="form-label">City<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-map-signs" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="city" id="city" placeholder="Enter City" value="{{ $agent->city }}" autocomplete = off>
                                    </div>
                                    @error('city')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                <div class="col-lg-6 mb-2">
                                    <label for="example-password" class="form-label">Zipcode<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-qrcode" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="postal_code" id="postal_code" placeholder="Enter Zipcode" value="{{ $agent->postal_code }}" autocomplete = off>
                                    </div>
                                    @error('postal_code')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                </div>
                                <button class="btn btn-primary" type="submit" id="submit_btn" name="agent_btn">Update</button>

                            </form>
                            </div>
                            <!-- Customer Information end  -->


                            <!-- Account Information start  -->
                            <div class="tab-pane" id="profile-tab-2">
                            <form action="{{ route('agent.account_update',$agent->id) }}" method="POST" id="check_validation" class="parsley-examples">
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

                            <!-- Billing Information start  -->

                            <div class="tab-pane" id="finish-2">
                                <div class="row">
                                    <div class="col-md-12">
                                      <div class="col-md-1" style="float: right;">
                                        <a href="#" class="btn btn-block btn-secondary" title="Add New BillPlan" onclick="addBillplan({{$agent->id}})" ><i class="fa fa-plus-circle"></i></a><br>
                                        <br>
                                      </div> 
                                
                                        <div class="col-lg-12 mb-2" id="display_billplan">
                                 
                                        </div>
 
                                    </div>
                                </div> <!-- end row -->
                            </div><br>
                            <!-- Billing Information end  -->
                    </div> 
            </div> 
        </div> 
    </div> 
</div>

<!-- -----------  edit commission modal end ------------- -->

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
      <div class="modal-content" style="width: 50%;margin-left: 176px;">
        <div class="modal-header">
            <h4 class="modal-title">Edit Commission</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="POST" id="agent-commission-form" class="parsley-examples">
        @csrf 
          <div class="modal-body">
            <input class="form-control" onkeyup="handleChange(this);" onkeypress="return validateFloatKeyPress(this,event);" name="commission" type="text" id="agent_commission">
            <span class="text-red" id="error" style="display: none;">Commission cannot be blank</span>
            <input class="form-control" name="id" type="hidden"  id="commission_id">
          </div>
          <div class="modal-footer">
            <button type="button" onclick="update_commission();" class="btn btn-primary btn-sm">&nbsp; Update</button>
            <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
  </div>
</div>

<!-- -----------  edit commission modal end ------------- -->

<!-- -----------  Add billplan modal start ------------- -->

<div class="modal fade" id="modal-addbillplan" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content" style="width: 75%;margin-left: 94px;">
        <meta name="_token" content="{{csrf_token()}}" />
        <div class="modal-header">
           <h4 class="modal-title">Add New Billplan</h4>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="form-addBillplan">
            <form action="{{ route('agent.addbillplan',$agent->id) }}" method="POST" id="check_validation" class="parsley-examples">
            @csrf 
            <div class="row">                         
                <div class="col-lg-12 mb-2">
                    <label for="for-expire_seconds" class="form-label">Bill Plan Type<span class="text-red"> *</span></label>
                    <div class="input-group">
                    <span class="input-group-text"><i class="fa fa-bars"></i></span>
                    <select class="form-control" name="billplan_id"  title="Type" id="AgentBillplan_billplan_id">
                        <option disabled selected>Select Bill Plan Type</option>
                        @foreach ($billplans as $billplan)
                        <option value="{{$billplan->id}}" {{ old('billplan_id') == $billplan->id ? 'selected' : '' }}>{{$billplan->name}}</option>
                        @endforeach
                    </select>
                    </div>
                    @error('billplan_id')<p class="validation_error">{{ $message }}</p> @enderror
                </div>
                <div class="col-lg-12 mb-2">
                    <label for="example-password" class="form-label">Commission(%)<span class="text-red"> *</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><b>%</b></span>
                        <input type="text" class="form-control" name="commission" id="AgentBillplan_commission" placeholder="Enter Commission(%)" value="{{ old('commission',0) }}" autocomplete = off>
                    </div>
                    @error('commission')<p class="validation_error">{{ $message }} </p>@enderror
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-sm">Save</button>
          <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
  </div>
</div>


<!-- ----------- End Add billplan modal end ------------- -->

<script type="text/javascript">
$(document).ready(function() {
$("#agent").click(function(){
    $("#account-2").show();
    $("#profile-tab-2").hide();
    $("#finish-2").hide();
});
$("#account").click(function(){
    $("#account-2").hide();
    $("#profile-tab-2").show();
    $("#finish-2").hide();
});
$("#billing").click(function(){
    $("#account-2").hide();
    $("#profile-tab-2").hide();
    $("#finish-2").show();
});  
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $.ajaxSetup({
      headers: {
         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      }
    });

    $.ajax({
        type: 'POST',
        url: "{{ route('agent.displaybillplan',$agent->id) }}",
        data: $('#check_validation').serialize(),
        success: function (result) {

            $('#display_billplan').html(result);

        },
        
    });
});

function editCommission(id,commission) {
    $('#agent_commission').val(commission);
    $('#commission_id').val(id);
    $('#modal-default').modal('show');
  }

  function update_commission() {
    if ($('#agent_commission').val() == '') {
      $('#error').css('display', 'block');
      return false;
    }
    $.ajax({
        type: 'POST',
        url: "{{ route('agent.editcommission') }}",
        data: $('#agent-commission-form').serialize(),
        success: function (result) {
          $('#modal-default').modal('hide');
          window.location.reload(true);
        },
    });
  }

function deleteBillplan(id) {
  $.ajax({
    type: 'GET',
    url: "{{ route('agent.deletebillplan') }}",
    data: {'id':id},
    success: function (result) {
      window.location.reload(true);
    },
   
  });
}

function addBillplan(id) {

    $('#modal-addbillplan').modal('show');
}

function validateFloatKeyPress(el, evt) {
  var charCode = (evt.which) ? evt.which : event.keyCode;
  var number = el.value.split('.');
  if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
  return false;
  }
  //just one dot
  if(number.length>1 && charCode == 46){
  return false;
  }
  //get the carat position
  var caratPos = getSelectionStart(el);
  var dotPos = el.value.indexOf(".");
  if( caratPos > dotPos && dotPos>-1 && (number[1].length > 1)){
  return false;
  }
  return true;
}

function getSelectionStart(o) {
  if (o.createTextRange) {
  var r = document.selection.createRange().duplicate()
  r.moveEnd('character', o.value.length)
  if (r.text == '') return o.value.length
  return o.value.lastIndexOf(r.text)
  } else return o.selectionStart
}

function handleChange(input) {
  if (input.value < 0) input.value = 0;
  if (input.value > 100) input.value = 100;
}

</script>
@endsection
<script src="{{ asset('js/validation.js') }}" defer></script>



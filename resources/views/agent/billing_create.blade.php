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
                             <h4 class="page-title"><i class="fa fa-users" aria-hidden="true"></i> Add Agent</h4>
                        </div>
                    </div>
                    <!-- header end-->

                    <form action="{{ route('agent.billstore') }}" method="POST" id="check_validation" class="parsley-examples">
                    @csrf
                     <div id="basicwizard">

                        <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-3">
                        <li class="nav-item">
                            <a href="#" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                <i class="mdi mdi-account-circle me-1"></i>
                                <span class="d-none d-sm-inline">Agent Personal Information</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2 ">
                                <i class="mdi mdi-face-profile me-1"></i>
                                <span class="d-none d-sm-inline">Account Credential</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2 active">
                                <i class="mdi mdi-checkbox-marked-circle-outline me-1"></i>
                                <span class="d-none d-sm-inline">Billing Information</span>
                            </a>
                        </li>
                        </ul>
                                            
                        <div class="tab-content b-0 mb-0 pt-0">
    
                            <!-- Billing Information start -->            
                            <div>
                                <div class="row">
                               
                                <div class="col-lg-4 mb-2">
                                    <label for="for-expire_seconds" class="form-label">Bill Plan Type<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-bars"></i></span>
                                    <select class="form-control" name="billplan_id"  title="Type" id="AgentBillplan_billplan_id">
                                       <option disabled >Select Bill Plan Type</option>
                                        @foreach ($billplans as $billplan)
                                        <option value="{{$billplan->id}}" {{ old('billplan_id') == $billplan->id ? 'selected' : '' }}>{{$billplan->name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                @error('billplan_id')<p class="validation_error">{{ $message }}</p> @enderror
                                </div>

                                <div class="col-lg-4 mb-2">
                                    <label for="example-password" class="form-label">Commission<span class="text-red"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><b>%</b></span>
                                        <input type="text" class="form-control" name="commission" id="AgentBillplan_commission" placeholder="Enter Commission(%)" value="{{ old('commission',0) }}" autocomplete = off>
                                    </div>
                                    @error('commission')<p class="validation_error">{{ $message }} </p>@enderror
                                </div>

                                
                                <div class="col-lg-4 mb-2">
                                    <label for="example-password" class="form-label">Add</label>
                                    <div class="input-group">
                                        <a href="#" id="add_commission"><i class="fa fa-plus-circle text-green" style="font-size: x-large;"></i></a>
                                    </div>
                                </div>

                                <div class="col-lg-12 mb-2" id="set_commission">
                                 
                                </div>

                            </div>

                            </div><br>
                            <!-- Billing Information end  -->

                            <ul class="list-inline mb-0 wizard">
                                <li class="previous list-inline-item">
                                    <a href="{{ URL::to('/agents/customer-info?view=agent.account_create') }}" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
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
$(document).on('click', '#add_commission', function (e) {
   var id = document.getElementById('AgentBillplan_billplan_id').value;
   $.ajaxSetup({
      headers: {
         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      }
   });

    $.ajax({
        type: 'POST',
        url: "{{ route('agent.addcommission') }}",
        data: $('#check_validation').serialize(),
        success: function (result) {

            $("#AgentBillplan_commission").val('0');
            $("#AgentBillplan_billplan_id option[value='"+id+"']").remove();
            $('#set_commission').html(result);

        },
        error: function () {
        }
    });
});

function delete_commission(billplan_id) {
    $.ajax({
        type: 'GET',
        url: "{{ route('agent.deletecommission') }}",
        data: {'id':billplan_id},
        success: function (result) {
            var obj = JSON.parse(result)

            $('#set_commission').html(obj.html);
            $(obj.select).appendTo("#AgentBillplan_billplan_id");
        },
        error: function () {
        }
    });
}
</script>

@endsection
<script src="{{ asset('js/validation.js') }}" defer></script>



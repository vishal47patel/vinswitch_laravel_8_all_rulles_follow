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
                             <h4 class="page-title"><i class="fa fa-paste" aria-hidden="true"></i> Update Origination Bill Plan</h4>
                        </div>
                         <div class="col-md-6 pull-right mb-1">
                            <a class="btn btn-primary" href="{{ route('originationBillPlan.index') }}"><i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <!-- header end-->
                        
                    <form action="{{ route('originationBillPlan.update',$OriginationBillPlan->id) }}" method="POST" id="check_validation" class="parsley-examples">
                    @csrf
                        <div class="row">

                            <div class="col-lg-6 mb-2">
                                <label for="for-expire_seconds" class="form-label">Bill Plan Type<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-qrcode"></i></span>
                                    <select class="form-control" name="bill_plan_type"  title="Type">
                                      <option disabled="" selected>Select Bill Plan Type</option>
                                      <option value="POSTPAID" @if($OriginationBillPlan->bill_plan_type == 'POSTPAID') selected @endif>POSTPAID</option>
                                      <option value="PREPAID" @if($OriginationBillPlan->bill_plan_type == 'PREPAID') selected @endif>PREPAID</option>
                                    </select>
                                </div>
                                @error('type')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-6 mb-2">                                    
                                <label for="simpleinput" class="form-label">Bill Plan Name<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-keyboard"></i></span>
                                    <input type="text" class="form-control" name="bill_plan_name" id="bill_plan_name" placeholder="Enter Bill Plan Name" value="{{ $OriginationBillPlan->bill_plan_name }}" autocomplete = off >
                                </div>
                                @error('name')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-6 mb-2">
                                <label for="origination_rate_plan" class="form-label">Origination Rate Plan<span class="text-red"> *</span></label>
                                 <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-map-signs"></i></span>
                                    <select class="form-control" name="origination_rate_plan"  title="Origination Rate Plan">
                                      <option disabled="" selected>Select Origination Rate Plan</option>
                                       @foreach ($OriginationRatePlans as $OriginationRatePlan)
                                        <option value="{{$OriginationRatePlan->id}}" {{ $OriginationBillPlan->origination_rate_plan == $OriginationRatePlan->id ? 'selected' : '' }}>{{$OriginationRatePlan->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('origination_rate_plan')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-6 mb-2">
                                <label for="description" class="form-label">Description</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-bars"></i></span>
                                    <input type="text" class="form-control" name="description" id="description" placeholder="Enter Description" value="{{ $OriginationBillPlan->description }}" autocomplete = off>
                                </div>
                                @error('description')<p class="validation_error">{{ $message }}</p> @enderror
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



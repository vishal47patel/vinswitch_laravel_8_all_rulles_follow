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
                            <h4 class="page-title"><i class="fa fa-paste" aria-hidden="true"></i> Add New Bill Plan</h4>
                        </div>
                         <div class="col-md-6 pull-right mb-1">
                            <a class="btn btn-primary" href="{{ route('billPlan.index') }}"><i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <!-- header end-->
                        
                    <form action="{{ route('billPlan.store') }}" method="POST" id="check_validation" class="parsley-examples">
                    @csrf
                        <div class="row">

                            <div class="col-lg-3 mb-2">
                                <label for="for-expire_seconds" class="form-label">Type<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-map-signs"></i></span>
                                    <select class="form-control" name="type" title="Type">
                                        <option disabled="" selected>Select Type</option>
                                        <option value="POSTPAID" @if('type'=='POSTPAID' ) selected @endif>POSTPAID</option>
                                        <option value="PREPAID" @if('type'=='PREPAID' ) selected @endif>PREPAID</option>
                                    </select>
                                </div>
                                @error('type')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-3 mb-2">
                                <label for="simpleinput" class="form-label">Name<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-map-signs"></i></span>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value="{{ old('name') }}" autocomplete=off>
                                </div>
                                @error('name')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-3 mb-2">
                                <label for="initial_increment" class="form-label">Initial Increment</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-map-signs"></i></span>
                                    <input type="text" class="form-control" name="initial_increment" id="initial_increment" placeholder="Enter Initial Increment" value="{{ old('initial_increment',0) }}" autocomplete = off>
                                </div>
                                @error('initial_increment')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-3 mb-2">
                                <label for="pulse_rate" class="form-label">Pulse Rate<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-map-signs"></i></span>
                                    <input type="text" class="form-control" name="pulse_rate" id="pulse_rate" placeholder="Enter Pulse Rate" value="{{ old('pulse_rate',60) }}" autocomplete=off>
                                </div>
                                @error('pulse_rate')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-12 mb-2">
                                <label for="description" class="form-label">Description</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-info"></i></span>
                                    <textarea name="description" class="form-control" cols="5" rows="2" name="description" id="description" placeholder="Enter Description" value="{{ old('description') }}" autocomplete=off>{{ old('description') }}</textarea>
                                </div>
                                @error('description')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-3 mb-2">
                                <label for="monthly_payment" class="form-label">Monthly Payment<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                                    <input type="text" class="form-control number" name="monthly_payment" id="monthly_payment" placeholder="Enter Pulse Rate" value="{{ old('monthly_payment','0.00') }}" autocomplete=off>
                                </div>
                                @error('monthly_payment')<p class="validation_error">{{ $message }} </p>@enderror
                            </div>

                            <div class="col-lg-3 mb-2">
                                <label for="monthly_mins" class="form-label">Monthly Minutes<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-database"></i></span>
                                    <input type="text" class="form-control number" name="monthly_mins" id="monthly_mins" placeholder="Enter Monthly Minutes" value="{{ old('monthly_mins',0) }}" autocomplete=off>
                                </div>
                                @error('monthly_mins')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-3 mb-2">
                                <label for="sip_account_price" class="form-label">SIP Account Price<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                                    <input type="text" class="form-control number" name="sip_account_price" id="sip_account_price" placeholder="Enter SIP Account Price" value="{{ old('sip_account_price','0.00000') }}" autocomplete=off>
                                </div>
                                @error('sip_account_price')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-3 mb-2">
                                <label for="end_point_price" class="form-label">End Point Price<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                                    <input type="text" class="form-control number" name="end_point_price" id="end_point_price" placeholder="Enter End Point Price" value="{{ old('end_point_price','0.00000') }}" autocomplete=off>
                                </div>
                                @error('end_point_price')<p class="validation_error">{{ $message }} </p>@enderror
                            </div>

                            <div class="col-lg-3 mb-2">
                                <label for="outbound_sms_price" class="form-label">Outbound SMS Price<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                                    <input type="text" class="form-control number" name="outbound_sms_price" id="outbound_sms_price" placeholder="Enter Pulse Rate" value="{{ old('outbound_sms_price','0.00000') }}" autocomplete=off>
                                </div>
                                @error('outbound_sms_price')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-3 mb-2">
                                <label for="rateplan_id" class="form-label">Termination Rateplan<span class="text-red"> *</span></label>
                                <div class="input-group multipleselect">
                                    <span class="input-group-text"><i class="fa fa-object-group"></i></span>
                                    <select class="select2-multiple form-control"  name="rateplan_id[]"  title="rateplan_id" id="rateplan_id" multiple="multiple">
                                    @foreach ($sofia_rate_plans as $sofia_rate_plan)
                                    <option value="{{$sofia_rate_plan->id}}" {{ old('rateplan_id') == $sofia_rate_plan->id ? 'selected' : '' }}>{{$sofia_rate_plan->plan_name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                @error('rateplan_id')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-3 mb-2">
                                <label for="per_channel_price" class="form-label">Per Channel Price</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                                    <input type="text" class="form-control number" name="per_channel_price" id="per_channel_price" placeholder="Enter SIP Account Price" value="{{ old('per_channel_price','0.00000') }}" autocomplete=off>
                                </div>
                                @error('per_channel_price') <p class="validation_error">{{ $message }}</p> @enderror
                            </div>


                            <div class="col-lg-3 mb-2">
                                <label for="method" class="form-label">Method</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-square"></i></span>
                                    <select class="form-control" name="method" title="method" id="method">
                                        <option disabled="" selected>Select Method</option>
                                        <option value="LCR" @if('method'=='LCR' ) selected @endif>LCR</option>
                                    </select>
                                </div>
                                @error('method')<p class="validation_error">{{ $message }}</p> @enderror
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
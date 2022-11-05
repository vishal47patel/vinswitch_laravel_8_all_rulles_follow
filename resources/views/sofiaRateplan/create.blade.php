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
                             <h4 class="page-title"><i class="fa fa-object-group" aria-hidden="true"></i> Add New Termination RatePlan</h4>
                        </div>
                         <div class="col-md-6 pull-right mb-1">
                            <a class="btn btn-primary" href="{{ route('sofiaRateplan.index') }}"><i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <!-- header end-->
                        
                    <form action="{{ route('sofiaRateplan.store') }}" method="POST" id="check_validation" class="parsley-examples">
                    @csrf
                        <div class="row">

                            <div class="col-lg-6 mb-2">                                    
                                <label for="simpleinput" class="form-label">Plan Name<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-map-signs"></i></span>
                                    <input type="text" class="form-control" name="plan_name" id="plan_name" placeholder="Enter Plan Name" value="{{ old('plan_name') }}" autocomplete = off >
                                </div>
                                @error('plan_name')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-6 mb-2">
                                <label for="initial_increment" class="form-label">Concurrent Call<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-bars"></i></span>
                                    <input type="text" class="form-control" name="cc" id="cc" placeholder="Enter Concurrent Call" value="{{ old('cc',0) }}" autocomplete = off>
                                </div>
                                @error('cc')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-6 mb-2">
                                <label for="pulse_rate" class="form-label">Max Call Length<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-th-list" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="max_call_length" id="max_call_length" placeholder="Enter Max Call Length" value="{{ old('max_call_length',0) }}" autocomplete = off>
                                </div>
                                @error('max_call_length')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-6 mb-2">
                                <label for="for-expire_seconds" class="form-label">Status<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-adjust"></i></span>
                                    <select class="form-control" name="status"  title="Status">
                                      <option value="ACTIVE" @if('status' == 'ACTIVE') selected @endif>ACTIVE</option>
                                      <option value="INACTIVE" @if('status' == 'INACTIVE') selected @endif>INACTIVE</option>
                                    </select>
                                </div>
                                @error('status')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-5 mb-2">
                                <label for="for-expire_seconds" class="form-label">Available Gateway</label>
                                    <select class="form-control"  name="available"  title="Available Gateway" id="lstBox1" multiple="multiple">
                                    @foreach ($gateways as $gateway)
                                    <option value="{{$gateway->id}}" {{ old('available') == $gateway->id ? 'selected' : '' }}>{{$gateway->gateway_name}}</option>
                                    @endforeach
                                    </select>
                            </div>

                            <div class="subject-info-arrows text-center col-md-1">
                                <label for="SofiaRateplan_gate">&nbsp;</label><br>
                                <input type='button' id='btnRight' value='>' class="btn btn-default down_btn" /><br /><br>
                                <input type='button' id='btnLeft' value='<' class="btn btn-default down_btn" /><br />
                            </div>

                            <div class="col-lg-5 mb-2">
                                <label for="for-gateway_id" class="form-label">Selected Gateway<span class="text-red"> *</span></label>
                                    <select class="form-control"  name="gateway_id[]"  title="Selected Gateway" id="lstBox2" multiple="multiple">
                                    @foreach ($sofiaplanways as $sofiaplanway)
                                    <option value="{{$sofiaplanway->id}}" {{ old('gateway_id') == $sofiaplanway->id ? 'selected' : '' }}>{{$sofiaplanway->gateway_name}}</option>
                                    @endforeach
                                    </select>
                                    @error('gateway_id')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-md-1">
                                <label for="SofiaRateplan_gate">&nbsp;</label><br>
                                <button type="button" class="btn btn-default up_btn" id="btnSiftUp">
                                    <i class="fa fa-chevron-up" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btn btn-default down_btn" id="btnSiftDown">
                                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                </button>
                                
                            </div>

                        </div>
                        <button class="btn btn-primary" type="submit" id="submit_btn" onclick="return selectAll(document.getElementById('lstBox2'),true);">Submit</button>
                    </form>
                        
                </div> 
            </div> 
        </div>
    </div>
</div> 
<script src="{{ asset('js/termination_rateplan.js') }}" defer></script>
@endsection
<script src="{{ asset('js/validation.js') }}" defer></script>



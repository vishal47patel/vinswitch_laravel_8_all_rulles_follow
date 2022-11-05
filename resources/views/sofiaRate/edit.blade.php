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
                             <h4 class="page-title"><i class="fa fa-paste" aria-hidden="true"></i> Update Termination Rates : {{$sofiarateplan->plan_name}}</h4>
                        </div>
                         <div class="col-md-6 pull-right mb-1">
                            <a class="btn btn-primary" href="{{ route('sofiaRate.index',$sofiarateplan->id) }}"><i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <!-- header end-->
                        
                    <form action="{{ route('sofiaRate.update',$sofiarate->id) }}" method="POST" id="check_validation" class="parsley-examples">
                    @csrf
                        <div class="row">

                            <div class="col-lg-6 mb-2">                                    
                                <label for="simpleinput" class="form-label">Code<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-code-fork"></i></span>
                                    <input type="text" class="form-control" name="code" id="code" placeholder="Enter Code" value="{{ $sofiarate->code }}" autocomplete = off onkeypress="return onlyNumberKey(event)">
                                </div>
                                @error('code')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-6 mb-2">
                                <label for="initial_increment" class="form-label">Description<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-map-signs"></i></span>
                                    <input type="text" class="form-control" name="description" id="description" placeholder="Enter Description" value="{{ $sofiarate->description }}" autocomplete = off>
                                </div>
                                @error('description')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-4 mb-2">
                                <label for="pulse_rate" class="form-label">Buy Rate<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                                    <input type="text" class="form-control" name="buy_rate" id="buy_rate" placeholder="Enter Buy Rate" value="{{ $sofiarate->buy_rate }}" autocomplete = off onkeypress="return onlyNumberKey(event)">
                                </div>
                                @error('buy_rate')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-4 mb-2">
                                <label for="for-expire_seconds" class="form-label">Sell Rate(%)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><b>%</b></span>
                                    <input type="text" class="form-control number" name="sale_percentage" id="sale_percentage" placeholder="Enter Sell Rate(%)" value="{{ $sofiarate->sale_percentage }}" autocomplete = off>
                                </div>
                                @error('sale_percentage')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-4 mb-2">
                                <label for="for-expire_seconds" class="form-label">Sell Rate</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                                    <input type="text" class="form-control" name="sale_rate" id="sale_rate" placeholder="Enter Sell Rate" value="{{ $sofiarate->sale_rate }}" autocomplete = off>
                                </div>
                                @error('sale_rate')<p class="validation_error">{{ $message }}</p> @enderror
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



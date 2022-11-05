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
                            <h4 class="page-title"><i class="fas fa-paste" aria-hidden="true"></i> Add Vendor Setting Detail</h4>
                        </div>
                        <div class="col-md-6 pull-right mb-1">
                            <a class="btn btn-primary" href="{{ route('vendors.index') }}"><i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <!-- header end-->

                    <form action="{{ route('vendor.settings.store') }}" method="POST" id="check_validation_vendor_settings">
                        @csrf
                        <input type="hidden" name="vendor_id" value="{{$vendor_id}}" />
                        <div class="row">
                            <div class="col-lg-6 mb-2 validation_message ">
                                <label for="for-setting_key" class="form-label">Setting Key <span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-user-large"></i></span>
                                    <input type="text" class="form-control" name="setting_key" id="setting_key" placeholder="Enter Setting Key" value="{{ old('setting_key') }}" autocomplete=off>
                                </div>
                                
                                @error('setting_key')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-6 mb-2 validation_message">
                                <label for="for-setting_value" class="form-label">Setting Value<span class="text-red"> *</span></label>
                                <div class="input-group">

                                    <span class="input-group-text"><i class="far fa-keyboard"></i></span>
                                    <input type="text" class="form-control" name="setting_value" id="setting_value" placeholder="Enter Setting Value" value="{{ old('setting_value') }}" autocomplete=off />
                                </div>

                                @error('setting_value')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>
                        
                        </div>

                        <button class="btn btn-primary float-end" type="submit">Add</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<script src="{{ asset('js/vendor_settings.js') }}" defer></script>
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
                            <h4 class="page-title"><i class="far fa-building" aria-hidden="true"></i> Import Number Detail</h4>
                        </div>
                        <div class="col-md-6 pull-right mb-1">
                            <a class="btn btn-primary" href="{{ route('numbers.index') }}" title="Back"><i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <!-- header end-->

                    <form action="{{ route('numbers.import.store') }}" method="POST" id="check_validation_did_numbers_import" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-lg-6 mb-2 validation_message">
                                <label for="for-prefix" class="form-label">Service Type<span class="text-red"> *</span></label>
                                <div class="input-group">

                                    <span class="input-group-text"><i class="far fa-keyboard"></i></span>
                                    <select class="select2-multiple1 form-control" name="number_service_type" title="Service Type" id="number_service_type">
                                        <option value="">Select</option>
                                        @isset($services)
                                        @foreach($services as $service)
                                        <option value="{{$service->id}}" {{ ($service->id == old('number_service_type')) ? 'selected' : '' }}>{{$service->service_type}}</option>
                                        @endforeach
                                        @endisset

                                    </select>
                                </div>

                                @error('number_service_type')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>




                            <div class="col-lg-6 mb-2 validation_message">
                                <label for="for-username" class="form-label">Channel Limit <span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class=" fab fa-odnoklassniki"></i></span>
                                    <input type="text" class="form-control" name="number_channel_limit" id="number_channel_limit" placeholder="Enter Username" value="{{ old('number_channel_limit') }}" autocomplete=off />
                                </div>

                                @error('number_channel_limit')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-6 mb-2 validation_message">
                                <label for="for-password" class="form-label">Country <span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-map"></i></span>
                                    <select class="select2-multiple1 form-control" name="number_country" title="Country" id="number_country" onchange="getState(this,'number_state')">
                                        <option value="">Select</option>
                                        @isset($countries)
                                        @foreach($countries as $service)
                                        <option value="{{$service->ID}}" {{ ($service->ID == old('number_country')) ? 'selected' : '' }}>{{$service->Name}}</option>
                                        @endforeach
                                        @endisset
                                    </select>

                                </div>

                                @error('number_country')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>



                            <div class="col-lg-6 mb-2 validation_message">
                                <label for="for-auth_username" class="form-label">State</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                    <select class="select2-multiple1 form-control" name="number_state" title="State" id="number_state" onchange="getCities(this, 'number_area')">
                                        <option value="">Select</option>


                                    </select>
                                </div>
                                @error('number_state')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-4 mb-2 validation_message">
                                <label for="for-realm" class="form-label">Area</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-qrcode"></i></span>
                                    <select class="select2-multiple1 form-control" name="number_area" title="Area" id="number_area">
                                        <option value="">Select</option>

                                    </select>

                                </div>

                                @error('number_area')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>
                            <div class="col-lg-4 mb-2 validation_message">
                                <label for="for-realm" class="form-label">Area</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-cloud-upload-alt"></i></span>
                                    <input type="file" class="form-control" name="import_number" id="import_number" accept=".csv">

                                </div>
                            </div>
                            <div class="col-lg-4 mb-2 validation_message">
                                <label for="for-realm" class="form-label">Download sample file</label>
                                <div class="input-group">                                    
                                    <a href="{{route('numbers.sample.download')}}" title="Download">
                                        <span class="input-group-text bg-primary">
                                            <i class="fas fa-download text-white"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mb-2 validation_message">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="sms_capable" id="sms_capable" value="YES">
                                    <label class="form-check-label" for="customCheck1">SMS Capable</label>
                                </div>
                                @error('sms_capable')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <button class="btn btn-primary float-end" type="submit" title="Import Record"> Import</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<script src="{{ asset('js/numbers.js') }}" defer></script>
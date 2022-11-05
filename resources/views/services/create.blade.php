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
                             <h4 class="page-title"><i class="fa fa-paste" aria-hidden="true"></i>  Add New Service Type</h4>
                        </div>
                         <div class="col-md-6 pull-right mb-1">
                            <a class="btn btn-primary" href="{{ route('services.index') }}"><i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <!-- header end-->
                        
                    <form action="{{ route('services.store') }}" method="POST" id="check_validation">
                    @csrf
                        <div class="row">
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Service Type<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-map-signs" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="service_type" id="service_type" placeholder="Enter Service Type" value="{{ old('service_type') }}" autocomplete = off >
                                </div>
                                @error('service_type')<p class="validation_error">{{ $message }} </p>@enderror
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Service Description<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-map-signs" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="service_description" id="service_description" placeholder="Enter Service Description" value="{{ old('service_description') }}" autocomplete = off >
                                </div>
                                @error('service_description')<p class="validation_error">{{ $message }} </p>@enderror
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </form>
                        
                </div> 
            </div> 
        </div>
    </div>
</div> 

@endsection
<script src="{{ asset('js/validation.js') }}" defer></script>



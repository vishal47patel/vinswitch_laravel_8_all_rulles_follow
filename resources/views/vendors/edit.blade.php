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
                            <h4 class="page-title"><i class="fas fa-paste" aria-hidden="true"></i> Edit Vendors Detail</h4>
                        </div>
                        <div class="col-md-6 pull-right mb-1">
                            <a class="btn btn-primary" href="{{ route('vendors.index') }}" title="Back"><i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <!-- header end-->
                    
                    <form action="{{ route('vendors.update', $record->id) }}" method="POST" id="check_validation_vendors">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4 mb-2 validation_message ">
                                <label for="for-vendor_name" class="form-label">Vendor Name<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-user-large"></i></span>
                                    <input type="text" class="form-control" name="vendor_name" id="vendor_name" placeholder="Enter Vendor Name" value="{{ $record->vendor_name }}" autocomplete=off>
                                </div>

                                @error('vendor_name')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>
                            
                            <div class="col-lg-4 mb-2 validation_message">
                                <label for="for-vendor_code" class="form-label">Vendor Code<span class="text-red"> *</span></label>
                                <div class="input-group">

                                    <span class="input-group-text"><i class="far fa-keyboard"></i></span>
                                    <input type="text" class="form-control" name="vendor_code" id="vendor_code" placeholder="Enter Username" value="{{ $record->vendor_code }}" autocomplete=off />
                                </div>

                                @error('vendor_code')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>
                           
                            <div class="col-lg-4 mb-2 validation_message">
                                <label for="for-did_type" class="form-label">Did Type <span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class=" fab fa-odnoklassniki"></i></span>
                                    <input type="text" class="form-control" name="did_type" id="did_type" placeholder="Enter Did Type" value="{{ $record->did_type }}" autocomplete=off />
                                </div>
                                

                                @error('did_type')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-4 mb-2 validation_message">
                                <label for="for-password" class="form-label">Status </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="far fa-flag"></i></span>
                                    <select class="select2-multiple1 form-control" name="status" title="Status" id="statusc">
                                        
                                        <option value="ENABLE" {{ ($record->status == 'ENABLE') ? 'selected' : '' }}>ENABLE</option>
                                        <option value="DISABLE" {{ ($record->status == 'DISABLE' || $record->status == '') ? 'selected' : '' }}>DISABLE</option>

                                    </select>
                                </div>
                                @error('status')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>
                            <div class="col-lg-4 mb-2 validation_message">
                                <label for="for-priority" class="form-label">Priority <span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fab fa-connectdevelop"></i></span>
                                    <input type="text" class="form-control" name="priority" id="priority" placeholder="Enter Priority" value="{{ $record->priority }}" autocomplete=off />                                    
                                </div>
                                @error('priority')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                        </div>

                        <button class="btn btn-primary float-end" type="submit" title="Update Record">Update</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="{{ asset('js/vendors.js') }}" defer></script>
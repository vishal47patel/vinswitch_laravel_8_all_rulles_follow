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
                             <h4 class="page-title"><i class="fa fa-paste" aria-hidden="true"></i>  Add New Rate for termination rateplan : {{$sofiarateplan->plan_name}}</h4>
                        </div>
                         <div class="col-md-6 pull-right mb-1">
                            <a class="btn btn-primary" href="{{ route('sofiaRate.index',$sofiarateplan->id) }}"><i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <!-- header end-->
                        
                    <form action="{{ route('sofiaRate.rate_import',$sofiarateplan->id) }}" method="POST" id="check_validation" class="parsley-examples" enctype="multipart/form-data">
                    @csrf
                        <div class="row">

                            <div class="col-lg-4 mb-2">
                                <label for="for-expire_seconds" class="form-label">Sell Rate(%)<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><b>%</b></span>
                                    <input type="text" class="form-control number" name="sale_percentage" id="sale_percentage" placeholder="Enter Sell Rate(%)" value="{{ old('sale_percentage') }}" autocomplete = off>
                                </div>
                                @error('sale_percentage')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-4 mb-2">
                                <label for="for-expire_seconds" class="form-label">Import CSV<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-file-excel"></i></span>
                                    <input type="file" class="form-control" name="import_csv" id="import_csv">
                                </div>
                                 @error('import_csv')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-4 mb-2">
                                <label for="for-expire_seconds" class="form-label">Download sample file</label>
                                <div class="input-group">
                                    <a class="btn btn-secondary" href="{{ route('sofiaRate.downloadsampleFile') }}" title="Download Sample File"><i class="fa fa-download" ></i></a>
                                </div>
                            </div>

                        </div>
                        <button class="btn btn-primary" type="submit" id="submit_btn">Import</button>
                    </form>
                        
                </div> 
            </div> 
        </div>
    </div>
</div> 
@endsection
<script src="{{ asset('js/validation.js') }}" defer></script>



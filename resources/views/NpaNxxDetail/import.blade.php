@extends('layouts.main')

@section('content')
<div class="container-fluid"><br>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                  
                    <!-- header start-->
                    <div class="row with-border mb-2">
                        <div class="col-md-6">
                        <h4 class="page-title"><i class="far fa-file" aria-hidden="true"></i> Import NPA/NXX</h4>
                        </div>
                         <div class="col-md-6 pull-right mb-1">
                            <a class="btn btn-primary btn-sm" href="{{ route('NpaNxxDetail.index',$id) }}"><i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <!-- header end-->
                    @include('layouts.flash_message')          
                    <form action="{{ route('NpaNxxDetail.store',$id) }}" method="POST" enctype="multipart/form-data" id="check_validation">
                    @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label">Import File</label>				
                                <!-- <div class="input-group">
                                    <span class="input-group-addon log"><i class="fa fa-cloud-upload"></i></span> -->
                                    <input type="file" class="form-control" name="lead_file" id="lead_file">
                                    @error('lead_file')<p class="validation_error">{{ $message }} </p>@enderror
                                <!-- </div> -->
                            </div>
                            <div class="form-group col-md-6">
                            <label class="form-label">Download sample file</label>		
                            <br>
                                <a class="btn btn-block btn-success btn-sm" title="Download" href="{{ route('NpaNxxDetail.downloadfile') }}"><i class="fa fa-download"></i> </a>
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


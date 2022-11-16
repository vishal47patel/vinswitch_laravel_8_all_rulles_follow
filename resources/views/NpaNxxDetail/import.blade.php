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
                    
                            <div class="col-lg-6 mb-2 validation_message">
                                <label for="for-realm" class="form-label">Import File</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-cloud-upload-alt"></i></span>
                                    <input type="file" class="form-control" name="lead_file" id="lead_file">
                                </div>
                                @error('lead_file')<p class="validation_error">{{ $message }} </p>@enderror
                            </div>
                            <div class="col-lg-6 mb-2 validation_message">
                                <label for="for-realm" class="form-label">Download sample file</label>
                                <div class="input-group">                                    
                                    <a href="{{ route('NpaNxxDetail.downloadfile') }}">
                                        <span class="input-group-text bg-primary">
                                            <i class="fas fa-download text-white"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>


                        </div>
                        <button class="btn btn-primary float-end" type="submit">Import</button>
                    </form>
                    
                    
                </div>
            </div> 
        </div> 
    </div>
</div>  

@endsection


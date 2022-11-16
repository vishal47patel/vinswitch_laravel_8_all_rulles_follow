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
                             <h4 class="page-title"><i class="fa fa-paste" aria-hidden="true"></i>  Edit Taxation</h4>
                        </div>
                         <div class="col-md-6 pull-right mb-1">
                            <a class="btn btn-primary" href="{{ route('taxation.index') }}" title="Back"><i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <!-- header end-->
                        
                    <form action="{{ route('taxation.update',$taxations->id) }}" method="POST" id="check_validation">
                    @csrf
                        <div class="row">
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Name<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="far fa-user" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value="{{ $taxations->name }}" autocomplete = off >
                                </div>
                                @error('name')<p class="validation_error">{{ $message }} </p>@enderror
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Rate "%"</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="far fa-keyboard" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="rate" id="rate" placeholder="Enter Rate '%'" value="{{ $taxations->rate }}" autocomplete = off >
                                </div>
                                @error('rate')<p class="validation_error">{{ $message }} </p>@enderror
                            </div>
                        </div>
                        <button class="btn btn-primary float-end" type="submit">Update</button>
                    </form>
                        
                </div> 
            </div> 
        </div>
    </div>
</div> 

@endsection
<script src="{{ asset('js/validation.js') }}" defer></script>



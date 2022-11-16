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
                             <h4 class="page-title"><i class="fa fa-paste" aria-hidden="true"></i> Edit NPA/NXX</h4>
                        </div>
                         <div class="col-md-6 pull-right mb-1">
                            <a class="btn btn-primary" href="{{ route('npaNxxMaster.index') }}"><i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <!-- header end-->
                        
                    <form action="{{ route('npaNxxMaster.update',$npaNxxMaster->id) }}" method="POST" id="check_validation">
                    @csrf
                        <div class="row">
                            

                            <div class="col-lg-6">
                                <label class="form-label">Name<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-map-signs" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value="{{ $npaNxxMaster->name }}" autocomplete = off >
                                </div>
                                <p class="validation_error">@error('name'){{ $message }} @enderror</p>
                            </div>

                            <div class="col-lg-6">                                    
                                <label class="form-label">Default<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-user-plus" aria-hidden="true"></i></span>
                                        <select class="form-control" name="isdefault"  title="Default">
                                        <option value="YES" @if($npaNxxMaster->isdefault == 'YES') selected @endif>YES</option>
                                        <option value="NO" @if($npaNxxMaster->isdefault == 'NO') selected @endif>NO</option>
                                        </select>
                                </div>       
                                <p class="validation_error">@error('isdefault'){{ $message }} @enderror</p>
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

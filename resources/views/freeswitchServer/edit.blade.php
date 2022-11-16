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
                             <h4 class="page-title"><i class="fa fa-paste" aria-hidden="true"></i>  Add Freeswitch Servers</h4>
                        </div>
                         <div class="col-md-6 pull-right mb-1">
                            <a class="btn btn-primary" href="{{ route('freeswitchServer.index') }}"><i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <!-- header end-->
                        
                    <form action="{{ route('freeswitchServer.update',$freeswitchserver->id) }}" method="POST" id="check_validation">
                    @csrf
                        <div class="row">
                            <div class="col-lg-6 mb-2">
                                <label for="example-email" class="form-label">Host<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="far fa-map" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="freeswitch_host" id="freeswitch_host" placeholder="Enter Host" value="{{ $freeswitchserver->freeswitch_host }}" autocomplete = off >
                                </div>
                                @error('freeswitch_host')<p class="validation_error">{{ $message }} </p>@enderror
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label for="example-email" class="form-label">Password<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-map-signs" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="freeswitch_password" id="freeswitch_password" placeholder="Enter Password" value="{{ $freeswitchserver->freeswitch_password }}" autocomplete = off >
                                </div>
                                @error('freeswitch_password')<p class="validation_error">{{ $message }} </p>@enderror
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label for="example-email" class="form-label">Port<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-map-signs" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="freeswitch_port" id="freeswitch_port" placeholder="Enter Port" value="{{ $freeswitchserver->freeswitch_port }}" autocomplete = off >
                                </div>
                                @error('freeswitch_port')<p class="validation_error">{{ $message }} </p>@enderror
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


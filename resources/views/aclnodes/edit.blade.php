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
                            <h4 class="page-title"><i class="fa fa-users " aria-hidden="true"></i> Edit ACL Detail</h4>
                        </div>
                        <div class="col-md-6 pull-right mb-1">
                            <a class="btn btn-primary" href="{{ route('aclnodes.index') }}"><i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <!-- header end-->

                    <form action="{{ route('aclnodes.update',$aclnodes->id) }}" method="POST" id="check_validation_aclnodes">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4 mb-2 validation_message ">
                                <label for="for-cidr" class="form-label">CIDR<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-keyboard"></i></span>
                                    <input type="text" class="form-control" name="cidr" id="cidr" placeholder="CIDR" value="{{ $aclnodes->cidr }}" autocomplete=off>
                                </div>

                                @error('cidr')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-4 mb-2 validation_message">
                                <label for="for-type" class="form-label">Type</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-keyboard"></i></span>
                                    <input type="text" class="form-control" name="type" id="type" placeholder="Type" value="{{ $aclnodes->type }}" autocomplete=off>
                                </div>

                                @error('type')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-4 mb-2 validation_message">
                                <label for="for-list" class="form-label">List</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-keyboard"></i></span>
                                    <!-- <input type="text" class="form-control" name="list" id="list" placeholder="List" value="{{ old('list') }}" autocomplete=off /> -->
                                    <select class="form-control" name="list_id" id="listacl" required>
                                        <option value="">Select</option>

                                        @isset($acllist)
                                        @foreach($acllist as $data)
                                        <option value="{{$data->id}}" {{($aclnodes->list_id == $data->id) ? 'selected' : '' }}>{{$data->acl_name}}</option>
                                        @endforeach
                                        @endisset

                                    </select>
                                </div>

                                @error('list')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 mb-2 validation_message">
                                <label for="for-is_endpoint" class="form-label">Endpoint</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-brands fa-odnoklassniki"></i></span>
                                    <select class="form-control" name="is_endpoint" title="is_endpoint">
                                        <option value="YES" selected @if($aclnodes->is_endpoint=='YES' ) selected @endif>YES</option>
                                        <option value="NO" @if($aclnodes->is_endpoint=='NO' ) selected @endif>NO</option>
                                    </select>
                                </div>

                                @error('is_endpoint')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>
                        </div>


                        <button class="btn btn-primary " style="float: right;" type="submit">Add</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<script src="{{ asset('js/aclnodes.js') }}" defer></script>
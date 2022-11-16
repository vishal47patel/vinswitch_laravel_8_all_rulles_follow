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
                            <h4 class="page-title"><i class="fas fa-users" aria-hidden="true"></i> Number List</h4>
                        </div>
                        <div class="col-md-6 pull-right mb-1">
                            @if ($operationPermission['create'])
                            <a class="btn btn-success btn-sm bg-success" href="{{ route('numbers.import.create') }}" title="Import Number"><i class="fas fa-cloud-upload-alt text-white"></i></a>
                            <a class="btn btn-primary btn-sm" href="{{ route('numbers.create') }}" title="Add New Number"><i class="fa fa-plus"></i></a>
                            @endif
                            <a class="btn btn-info btn-sm" data-bs-toggle="collapse" href="#searchSection" role="button" aria-expanded="false" aria-controls="collapseExample" title="Advance Search"><i class="fas fa-search"></i></a>

                        </div>
                        <div class="collapse @if(request()->query('number_did') != '' || request()->query('number_service_type') != '' || request()->query('number_channel_limit') != '' || request()->query('number_country') != '' || request()->query('number_state') != '' || request()->query('number_area') != '' || request()->query('number_description') != '')show @endif" id="searchSection">
                            <div class="card card-body">
                                <form action="{{ route('numbers.index') }}" method="GET" name="feildWiseSearchForm" class="feildWiseSearchForm" id="feildWiseSearchForm">
                                   
                                    <div class="row">
                                        <div class="col-lg-3 mb-2  ">
                                            <label for="for-gatway" class="form-label">Number</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="far fa-dot-circle"></i></span>
                                                <input type="text" class="form-control" name="number_did" id="number_did" placeholder="Enter Number Name" value="{{ request()->query('number_did') }}" autocomplete=off>
                                            </div>

                                        </div>

                                        <div class="col-lg-3 mb-2 ">
                                            <label for="for-prefix" class="form-label">Service Type</label>
                                            <div class="input-group">

                                                <span class="input-group-text"><i class="far fa-keyboard"></i></span>
                                                <select class="select2-multiple1 form-control" name="number_service_type" title="Service Type" id="number_service_type">
                                                    <option value="">Select</option>
                                                    @isset($services)
                                                    @foreach($services as $service)
                                                    <option value="{{$service->id}}" {{ ($service->id == request()->query('number_service_type')) ? 'selected' : '' }}>{{$service->service_type}}</option>
                                                    @endforeach
                                                    @endisset

                                                </select>
                                            </div>

                                        </div>

                                        <div class="col-lg-3 mb-2 ">
                                            <label for="for-username" class="form-label">Channel Limit </label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class=" fab fa-odnoklassniki"></i></span>
                                                <input type="text" class="form-control" name="number_channel_limit" id="number_channel_limit" placeholder="Enter Username" value="{{ request()->query('number_channel_limit') }}" autocomplete=off />
                                            </div>

                                        </div>

                                        <div class="col-lg-3 mb-2 ">
                                            <label for="for-password" class="form-label">Country </label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-map"></i></span>
                                                <select class="select2-multiple1 form-control" name="number_country" title="Country" id="number_country" onchange="getState(this,'number_state')">
                                                    <option value="">Select</option>
                                                    @isset($countries)
                                                    @foreach($countries as $service)
                                                    <option value="{{$service->ID}}" {{ ($service->ID == request()->query('number_country')) ? 'selected' : '' }}>{{$service->Name}}</option>
                                                    @endforeach
                                                    @endisset
                                                </select>

                                            </div>

                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 mb-2 ">
                                            <label for="for-auth_username" class="form-label">State</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                                <select class="select2-multiple1 form-control" name="number_state" title="State" id="number_state" onchange="getCities(this, 'number_area')">
                                                    <option value="">Select</option>


                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 mb-2 ">
                                            <label for="for-realm" class="form-label">Area</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-qrcode"></i></span>
                                                <select class="select2-multiple1 form-control" name="number_area" title="Area" id="number_area">
                                                    <option value="">Select</option>

                                                </select>

                                            </div>
                                        </div>

                                        <div class="col-lg-3 mb-2 ">
                                            <label for="for-from_user" class="form-label">Description</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                                                <input type="text" class="form-control" name="number_description" id="number_description" placeholder="Enter From User" value="{{ request()->query('number_description') }}" autocomplete=off />
                                            </div>

                                        </div>
                                        <div class="col-lg-3 mb-2 justify-content-around" align="right">
                                            
                                            <button class="btn btn-secondary m-3 ms-auto" type="button" onclick="resetForm('feildWiseSearchForm')" title="Reset Form"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                                            <button class="btn btn-info m-3 ms-auto" type="submit" title="Search"><i class="fas fa-search"></i></button>
                                            
                                            
                                        </div>


                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- header end-->
                    @include('layouts.flash_message')
                    <div class="row">
                        <div class="col-md-6">
                            @include('include.length_menu')
                        </div>
                        <div class="col-md-6">
                            @include('include.search')
                        </div>
                    </div>
                    <table data-toggle="table" data-show-columns="false" data-buttons-class="xs btn-light" data-page-list="[5, 10, 20]" data-page-size="5" data-pagination="true" class="tablesaw table mb-0" data-tablesaw-mode="stack">

                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Number</th>
                                <th>Service Type</th>
                                <th>Feature</th>
                                <th>Channel Limit</th>
                                <th>Company</th>
                                <th class="text-center">Status</th>
                                <th>Description</th>
                                <th class="action-text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dids as $key => $did)
                            <tr>
                                <td class="id-text-left">{{ ($dids->currentpage()-1) * $dids->perpage() + $key + 1 }}</td>
                                <td>{{ $did->number_did }}</td>
                                <td>{{ $did->number_service_type }}</td>
                                <td><a href="{{route('numbers.update.status', ['id' => $did->id, 'column' => 'sms_capable', 'value' => $did->sms_capable] )}}" @if($did->sms_capable == 'YES') class="text-success" title="Disable SMS" @else class="text-black-50" title="Enable SMS" @endif ><i class="fas fa-comment-alt"></i></a></td>
                                <td>{{ $did->number_channel_limit }}</td>
                                <td>{{ isset($did->tenant->company_name)?$did->tenant->company_name." - ":""}}{{$did->account_number }}</td>
                                <td class="text-center">
                                    <a @if($did->status == 'ALLOCATED') onclick="return confirm('Are you sure you want to port out?');" href="{{route('numbers.update.status', ['id' => $did->id, 'column' => 'status', 'value' => $did->status])}}" title="Port Out Number" @endif>
                                        <span @if($did->status == 'ALLOCATED') class="badge badge-soft-danger" @elseif($did->status == 'RESERVED') class="badge badge-soft-primary" @elseif($did->status == 'PORT OUT') class="badge badge-soft-dark" @else class="badge badge-soft-success" @endif >{{ $did->status }}</span>
                                    </a>
                                </td>

                                <td>{{ $did->number_description }}</td>
                                <td class="action-text-left">
                                    @if($did->status == 'AVAILABLE')
                                    @if ($operationPermission['update']) <a href="{{ route('numbers.edit',$did->id) }}"><i class="fa-solid fa-pen-to-square" title="Edit"></i></a> @endif
                                    @if ($operationPermission['delete']) <a href="{{ route('numbers.destroy',$did->id) }}" onclick="return confirm('Are you sure you want to delete this Number?');"><i class="fa-solid fa-trash-can text-danger" title="Delete"></i></a> @endif
                                    @endif
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
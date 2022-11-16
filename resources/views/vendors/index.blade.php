@extends('layouts.main')

@section('content')
@php
$previous_route_array = explode('/', url()->previous());
$current_route_array = explode('/', url()->current());

$alert = 'vendors';
if(in_array('vendor-settings', $previous_route_array) || in_array('vendor-settings', $current_route_array)){
    $alert = 'vendor-settings';
}
@endphp
<style>
    .vendor-list #global-search {
        float: right;
        width: 100% !important;
    }

    .vendor-setting #global-search2 {
        float: right;
        width: 70% !important;
    }
</style>
<div class="container-fluid"><br>

    <div class="row">
        <div class="col-sm-5">
            <div class="card">
                <div class="card-body vendor-list">
                    <!-- header start-->
                    <div class="row with-border mb-2">
                        <div class="col-md-6">
                            <h4 class="page-title"><i class="fas fa-th-large" aria-hidden="true"></i> Vendor List</h4>
                        </div>
                        <div class="col-md-6 pull-right mb-1">
                            @if ($operationPermission['create'])
                            <a class="btn btn-primary btn-sm" href="{{ route('vendors.create') }}" title="Add New Vendor"><i class="fa fa-plus"></i></a>
                            @endif
                            <!-- <a class="btn btn-info btn-sm" data-bs-toggle="collapse" href="#searchSection" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-search"></i></a> -->
                        </div>
                        <div class="collapse @if(request()->query('vendor_name') != '' )show @endif" id="searchSection">
                            <div class="card card-body">
                                <form action="{{ route('vendors.index') }}" method="GET" name="feildWiseSearchForm" class="feildWiseSearchForm" id="feildWiseSearchForm">
                                    <div class="row">
                                        <div class="col-lg-6 mb-2  ">
                                            <label for="for-gatway" class="form-label">Vendor</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="far fa-dot-circle"></i></span>
                                                <input type="text" class="form-control" name="vendor_name" id="vendor_name" placeholder="Enter Vendor Name" value="{{ request()->query('vendor_name') }}" autocomplete=off>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-2 justify-content-around" align="right">
                                            <button class="btn btn-secondary m-3 ms-auto" type="button" onclick="resetForm('feildWiseSearchForm')" title="Reset Form"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                                            <button class="btn btn-info m-3 ms-auto" type="submit" title="Search"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- header end-->
                    @if($alert == 'vendors')
                        @include('layouts.flash_message')
                    @endif
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
                                <th>Vendor Name</th>
                                <th class="text-center">Status</th>
                                <th>Priority</th>
                                <th>Setting</th>
                                <th class="action-text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vendors as $key => $vendor)
                            <tr>
                                <td class="id-text-left">{{ ($vendors->currentpage()-1) * $vendors->perpage() + $key + 1 }}</td>
                                <td>{{ $vendor->vendor_name }}</td>
                                <td class="text-center">
                                    <a onclick="return confirm('Are you sure you want to Update status?');" href="{{route('vendors.update.status', ['id' => $vendor->id, 'column' => 'status', 'value' => $vendor->status])}}" title="Change Status">
                                        <span @if($vendor->status == 'DISABLE') class="badge badge-soft-danger" @else class="badge badge-soft-success" @endif >{{ $vendor->status }}</span>
                                    </a>
                                </td>
                                <td>{{ $vendor->priority }}</td>
                                <td><a href="{{ route('vendors.index',['vendor_id' => $vendor->id]) }}" title="Open Vendor Setting"><i class="fa fa-cog" aria-hidden="true">{{ $vendor->id }}</i></td>
                                <td class="action-text-left">

                                    @if ($operationPermission['update']) <a href="{{ route('vendors.edit',$vendor->id) }}"><i class="fa-solid fa-pen-to-square" title="Edit"></i></a> @endif
                                    @if ($operationPermission['delete']) <a href="{{ route('vendors.destroy',$vendor->id) }}" onclick="return confirm('Are you sure you want to delete this Vendor?');"><i class="fa-solid fa-trash-can text-danger" title="Delete"></i></a> @endif

                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="card">
                <div class="card-body vendor-setting">
                    <!-- header start-->
                    <div class="row with-border mb-2">
                        <div class="col-md-6">
                            <h4 class="page-title"><i class="fa fa-cog" aria-hidden="true"></i></i> Vendor Settings List of : {{$record->vendor_name}}</h4>
                        </div>
                        <div class="col-md-6 pull-right mb-1">                            
                            @if ($operationPermission['create_setting'])
                            <a class="btn btn-primary btn-sm" href="{{ route('vendor.settings.create',$record->vendor_id) }}" title="Add New Vendor Setting"><i class="fa fa-plus"></i></a>
                            @endif
                        </div>
                    </div>
                    <!-- header end-->
                    @if($alert == 'vendor-settings')
                    @include('layouts.flash_message')
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            @include('include.length_menu2')
                        </div>
                        <div class="col-md-6">
                            @include('include.search2')
                        </div>
                    </div>
                    <table data-toggle="table" data-show-columns="false" data-buttons-class="xs btn-light" data-page-list="[5, 10, 20]" data-page-size="5" data-pagination="true" class="tablesaw table mb-0" data-tablesaw-mode="stack">

                        <thead class="table-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Setting Key</th>

                                <th scope="col">Setting Value</th>
                                <th class="action-text-left" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vendorsettings as $key => $value)
                            <tr>
                                <td scope="row">{{ ($vendorsettings->currentpage()-1) * $vendorsettings->perpage() + $key + 1 }}</td>
                                <td class="text-break w-25">{{ $value->setting_key }}</td>
                                <td class="text-break">{{ $value->setting_value }}</td>
                                <td class="action-text-left">

                                    @if ($operationPermission['update_setting']) <a href="{{ route('vendor.settings.edit',['id' => $value->id,'vendor_id' => $record->vendor_id]) }}"><i class="fa-solid fa-pen-to-square" title="Edit"></i></a> @endif
                                    @if ($operationPermission['delete_setting']) <a href="{{ route('vendor.settings.destroy',['id' => $value->id,'vendor_id' => $record->vendor_id]) }}" onclick="return confirm('Are you sure you want to delete this Vendor setting?');"><i class="fa-solid fa-trash-can text-danger" title="Delete"></i></a> @endif

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
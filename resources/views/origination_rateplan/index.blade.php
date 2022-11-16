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
                            <h4 class="page-title"><i class="fa fa-users" aria-hidden="true"></i> Origination Rate Plan</h4>
                        </div>
                        <div class="col-md-6 pull-right mb-1">
                            @if ($operationPermission['create'])
                            <a class="btn btn-primary btn-sm" href="{{ route('origination_rateplan.create') }}" title="Add"><i class="fa fa-plus"></i></a>
                            @endif
                            <a class="btn btn-info btn-sm" data-bs-toggle="collapse" title="Search" href="#searchSection" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-search"></i></a>
                        </div>
                        <div class="collapse @if(request()->query('name') != '')show @endif" id="searchSection">
                            <div class="card card-body">
                                <form action="{{ route('origination_rateplan.index') }}" method="GET" name="feildWiseSearchForm" class="feildWiseSearchForm" id="feildWiseSearchForm">
                                    <div class="row">
                                        <div class="col mb-2 ">
                                            <label for="for-gatway" class="form-label">Name</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value="{{ request()->query('name') }}" autocomplete=off>
                                            </div>
                                        </div>
                                        <div class="col mb-2 ">
                                            <label for="for-gatway" class="form-label">DID Price</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fab fa-odnoklassniki" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control" name="did_price" id="did_price" placeholder="Enter DID Price" value="{{ request()->query('did_price') }}" autocomplete=off>
                                            </div>
                                        </div>
                                        <div class="col mb-2 ">
                                            <label for="for-gatway" class="form-label">Setup Fee</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="far fa-keyboard" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control" name="setup_fee" id="setup_fee" placeholder="Enter Setup Fee" value="{{ request()->query('setup_fee') }}" autocomplete=off>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col mb-2 ">
                                            <label for="for-gatway" class="form-label">Inbound Min Rate</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="far fa-keyboard" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control" name="inbound_min_rate" id="inbound_min_rate" placeholder="Enter Inbound Min Rate" value="{{ request()->query('inbound_min_rate') }}" autocomplete=off>
                                            </div>
                                        </div>
                                        <div class="col mb-2 ">
                                            <label for="for-gatway" class="form-label">Inbound Channel Limit</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fab fa-odnoklassniki" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control" name="inbound_channel_limit" id="inbound_channel_limit" placeholder="Enter Inbound Channel Limit" value="{{ request()->query('inbound_channel_limit') }}" autocomplete=off>
                                            </div>
                                        </div>

                                        <div class="col mb-2 justify-content-around" align="right">
                                            <button class="btn btn-secondary m-3 ms-auto btn-sm" title="Reset" type="button" onclick="resetForm('feildWiseSearchForm')"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                                            <button class="btn btn-info m-3 ms-auto btn-sm" title="Search" type="submit"><i class="fas fa-search"></i></button>
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
                                <th class="id-text-left">#</th>
                                <th>Name</th>
                                <th>Service Type</th>
                                <th>Description</th>
                                <th class="action-text-left">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($OriginationRatePlan as $key => $origination)
                            <tr>
                                <td class="id-text-left">{{ ($OriginationRatePlan->currentpage()-1) * $OriginationRatePlan->perpage() + $key + 1 }}</td>
                                <td>{{ $origination->name }}</td>
                                <td>{{ @implode(',',array_column($origination->service_types->pluck('service')->toArray(), 'service_type')) }}</td>
                                <td>{{ $origination->description }}</td>
                                <td style="width: 14%;">
                                    @if ($operationPermission['view'])<a href="{{ route('origination_rateplan.show',$origination->id) }}"><i class="fa-solid fa-eye" title="Show"></i></a>@endif
                                    @if ($operationPermission['update'])<a href="{{ route('origination_rateplan.edit',$origination->id) }}"><i class="fa-solid fa-pen-to-square" title="Edit"></i></a>@endif
                                    @if ($operationPermission['delete'])<a href="{{ route('origination_rateplan.destroy',$origination->id) }}" onclick="return confirm('Are you sure you want to delete this Origination rate plan?');"><i class="fa-solid fa-trash-can text-danger" title="Delete"></i></a>@endif
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
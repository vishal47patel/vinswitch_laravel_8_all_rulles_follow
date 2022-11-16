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
                            <h4 class="page-title"><i class="fa fa-users" aria-hidden="true"></i> DID Service Type</h4>
                        </div>
                        <div class="col-md-6 pull-right mb-1">
                            @if ($operationPermission['create'])
                            <a class="btn btn-primary btn-sm" href="{{ route('services.create') }}" title="Add"><i class="fa fa-plus"></i></a>
                            @endif
                            <a class="btn btn-info btn-sm" data-bs-toggle="collapse" title="Search" href="#searchSection" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-search"></i></a>
                        </div>
                        <div class="collapse @if(request()->query('service_type') != '')show @endif" id="searchSection">
                            <div class="card card-body">
                                <form action="{{ route('services.index') }}" method="GET" name="feildWiseSearchForm" class="feildWiseSearchForm" id="feildWiseSearchForm">
                                    <div class="row">
                                        <div class="col mb-2 ">
                                            <label for="for-gatway" class="form-label">Service Type</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="far fa-keyboard" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control" name="service_type" id="service_type" placeholder="Enter service type" value="{{ request()->query('service_type') }}" autocomplete=off>
                                            </div>
                                        </div>

                                        <div class="col mb-2 justify-content-around" align="right">
                                            <button class="btn btn-secondary m-3 ms-auto btn-sm" type="button"  title="Reset" onclick="resetForm('feildWiseSearchForm')"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                                            <button class="btn btn-info m-3 ms-auto btn-sm" type="submit" title="Search"><i class="fas fa-search"></i></button>
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
                            <th>Service Type</th>
                            <th>Service Description</th>
                            <th class="action-text-left">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($services as $key => $service)
                        <tr>
                            <td class="id-text-left">{{ ($services->currentpage()-1) * $services->perpage() + $key + 1 }}</td>
                            <td>{{ $service->service_type }}</td>
                            <td>{{ $service->service_description }}</td>
                            <td class="action-text-left">
                                @if ($operationPermission['update'])<a href="{{ route('services.edit',$service->id) }}"><i class="fa-solid fa-pen-to-square" title="Edit"></i></a>@endif
                                @if ($operationPermission['delete'])<a href="{{ route('services.destroy',$service->id) }}" onclick="return confirm('Are you sure you want to delete this service?');"><i class="fa-solid fa-trash-can text-danger" title="Delete"></i></a>@endif
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
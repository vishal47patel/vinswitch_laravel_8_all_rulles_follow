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
                            <h4 class="page-title"><i class="fa fa-paste" aria-hidden="true"></i> NpaNxxMaster List</h4>
                        </div>
                        <div class="col-md-6 pull-right mb-1">
                            @if ($operationPermission['create'])
                            <a class="btn btn-primary btn-sm" href="{{ route('npaNxxMaster.create') }}" title="Add"><i class="fa fa-plus"></i></a>
                            @endif
                            <a class="btn btn-info btn-sm" data-bs-toggle="collapse" title="Search" href="#searchSection" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-search"></i></a>
                        </div>
                        <div class="collapse @if(request()->query('name') != '' || request()->query('isdefault') != '')show @endif" id="searchSection">
                            <div class="card card-body">
                                <form action="{{ route('npaNxxMaster.index') }}" method="GET" name="feildWiseSearchForm" class="feildWiseSearchForm" id="feildWiseSearchForm">
                                    <div class="row">
                                        <div class="col mb-2 ">
                                            <label for="for-gatway" class="form-label">Name</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa fa-map-signs" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value="{{ request()->query('name') }}" autocomplete=off>
                                            </div>
                                        </div>
                                        <div class="col mb-2">
                                            <label for="for-prefix" class="form-label">Default</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa fa-user-plus" aria-hidden="true"></i></span>
                                                <select class="form-control" name="isdefault" title="Default">
                                                    <option value="">Select</option>
                                                    <option value="YES" {{ (request()->query('isdefault') == 'YES') ? 'selected' : '' }}>YES</option>
                                                    <option value="NO" {{ (request()->query('isdefault') == 'NO') ? 'selected' : '' }}>NO</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col mb-2 justify-content-around" align="right">
                                            <button class="btn btn-secondary m-3 ms-auto btn-sm" type="button" title="Reset" onclick="resetForm('feildWiseSearchForm')"><i class="fa fa-refresh" aria-hidden="true"></i></button>
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
                                <th>Name</th>
                                <th>Default</th>
                                <th class="action-text-left">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($npaNxxMaster as $key => $npaNxx)
                            <tr>
                                <td class="id-text-left">{{ ($npaNxxMaster->currentpage()-1) * $npaNxxMaster->perpage() + $key + 1 }}</td>
                                <td>{{ $npaNxx->name }}</td>
                                <td>
                                   
                                    @if($npaNxx->isdefault =='YES')
                                    <span class="badge bg-success">Yes</span>
                                    @else
                                    <span class="badge bg-danger">No</span>
                                    @endif
                                </td>
                                <td style="width: 14%;">
                                    @if ($operationPermission['update'])<a href="{{ route('npaNxxMaster.edit',$npaNxx->id) }}"><i class="fa-solid fa-pen-to-square" title="Edit"></i></a>@endif
                                    @if ($operationPermission['detail'])<a href="{{ route('npaNxxMaster.show',$npaNxx->id) }}"><i class="fa-solid fa-list" title="NPA/NXX List"></i></a>@endif
                                    @if($npaNxx->isdefault =='NO') <a href="{{ route('npaNxxMaster.destroy',$npaNxx->id) }}" onclick="return confirm('Are you sure you want to delete this npaNxxMaster?');"><i class="fa-solid fa-trash-can text-danger" title="Delete"></i></a> @endif
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
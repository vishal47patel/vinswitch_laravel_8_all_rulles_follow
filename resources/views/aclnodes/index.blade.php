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
                            <h4 class="page-title"><i class="fa fa-cog" aria-hidden="true"></i> ACL</h4>
                        </div>
                        <div class="col-md-6 pull-right mb-1">

                            @if ($operationPermission['create'])
                            <a class="btn btn-primary btn-sm" href="{{ route('aclnodes.create') }}" title="Create Vendor"><i class="fa fa-plus"></i></a>
                            @endif
                            <a class="btn btn-info btn-sm" data-bs-toggle="collapse" href="#searchSection" role="button" aria-expanded="false" aria-controls="collapseExample" title="Advance Search"><i class="fas fa-search"></i></a>
                        </div>

                        <div class="collapse @if(request()->query('id') != '' || request()->query('cidr') != '' || request()->query('type') != '' || request()->query('list_id') != '' || request()->query('is_endpoint') != '')show @endif" id="searchSection">
                            <div class="card card-body">
                                <form action="{{ route('aclnodes.index') }}" method="GET" name="feildWiseSearchForm" class="feildWiseSearchForm" id="feildWiseSearchForm" >

                                    <div class="row">
                                        <div class="col-lg-4 mb-3">
                                            <label for="for-id" class="form-label">ID</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="far fa-dot-circle"></i></span>
                                                <input type="text" class="form-control" name="id" id="id" value="{{ request()->query('id') }}" autocomplete=off>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 mb-3">
                                            <label for="for-cidr" class="form-label">CIDR</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa fa-keyboard"></i></span>
                                                <input type="text" class="form-control" name="cidr" id="cidr" value="{{ request()->query('cidr') }}" autocomplete=off>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 mb-3">
                                            <label for="for-type" class="form-label">Type</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa fa-keyboard"></i></span>
                                                <input type="text" class="form-control" name="type" id="type" value="{{ request()->query('type') }}" autocomplete=off>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 mb-2 ">
                                            <label for="for-type" class="form-label">List</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa fa-keyboard"></i></span>
                                                <select class="form-control" name="list_id" id="list_id" >
                                                    <option value="">Select</option>
                                                    @isset($acllist)
                                                    @foreach($acllist as $data)
                                                    <option value="{{$data->id}}"> {{$data->acl_name}}</option>
                                                    @endforeach
                                                    @endisset
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 mb-2">
                                            <label for="for-prefix" class="form-label">Endpoint</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="far fa-keyboard"></i></span>
                                                <select class="select2-multiple1 form-control" name="is_endpoint"  id="is_endpoint">
                                                    <option value="">Select</option>
                                                    <option value="YES" {{ (request()->query('is_endpoint') == 'YES') ? 'selected' : '' }}>YES</option>
                                                    <option value="NO" {{ (request()->query('is_endpoint') == 'NO') ? 'selected' : '' }}>NO</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col mb-2 justify-content-around" align="right">
                                            <button class="btn btn-secondary m-3 ms-auto" type="button" onclick="resetForm('feildWiseSearchForm')"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                                            <button class="btn btn-info m-3 ms-auto" type="submit"><i class="fas fa-search"></i></button>
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
                                <th>CIDR</th>
                                <th>Type</th>
                                <th>List</th>
                                <th class="action-text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($aclnodes as $key => $acl)
                            <tr>
                                <td class="id-text-left">{{ ($aclnodes->currentpage()-1) * $aclnodes->perpage() + $key + 1 }}</td>
                                <td>{{ $acl->cidr }}</td>
                                @if($acl->type == "allow")
                                <td><a href="{{ route('aclnodes.changeType',$acl->id) }}"><span class="badge badge-soft-success">ALLOW</span></a></td>
                                @else
                                <td><a href="{{ route('aclnodes.changeType',$acl->id) }}"><span class="badge badge-soft-danger">DENY</span></a></td>
                                @endif
                                <td>{{ $acl->aclList->acl_name }}</td>

                                <td class="action-text-left">
                                    @if ($operationPermission['update']) <a href="{{ route('aclnodes.edit',$acl->id) }}"><i class="fa-solid fa-pen-to-square" title="Edit"></i></a> @endif
                                    @if ($operationPermission['delete']) <a href="{{ route('aclnodes.destroy',$acl->id) }}" onclick="return confirm('Are you sure you want to delete this ACL?');"><i class="fa-solid fa-trash-can text-danger" title="Delete"></i></a> @endif
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
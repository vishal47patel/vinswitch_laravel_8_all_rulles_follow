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
                             <h4 class="page-title"><i class="fa fa-users" aria-hidden="true"></i> Customers</h4>
                        </div>
                         <div class="col-md-6 pull-right mb-1">
                            @if ($operationPermission['create'])
                            <a class="btn btn-primary btn-sm" href="{{ route('tenant.create') }}" title="Add New Agent"><i class="fa fa-plus"></i></a>
                            @endif
                            <a class="btn btn-info btn-sm" data-bs-toggle="collapse" href="#searchSection" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-search"></i></a>
                        </div>
                            <!-- search start -->
                            <div class="collapse @if(request()->query('account_number') != '' || request()->query('first_name') != '' || request()->query('company_name') != '' || request()->query('status') != '' || request()->query('suspended') != '')show @endif" id="searchSection">
                                <form action="{{ route('tenant.index') }}" method="GET" name="feildWiseSearchForm" class="feildWiseSearchForm" id="feildWiseSearchForm">    
                                <div class="row">
                                    <div class="col mb-2 ">
                                        <label for="for-gatway" class="form-label">Account Number</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="account_number" id="account_number" placeholder="Agent Code" value="{{ request()->query('account_number') }}" autocomplete=off>
                                        </div>
                                    </div>

                                    <div class="col mb-2 ">
                                        <label for="for-gatway" class="form-label">Name</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Name" value="{{ request()->query('first_name') }}" autocomplete=off>
                                        </div>
                                    </div>

                                    <div class="col mb-2 ">
                                        <label for="for-gatway" class="form-label">Company Name</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Company Name" value="{{ request()->query('company_name') }}" autocomplete=off>
                                        </div>
                                    </div>

                                    <div class="col mb-2">
                                        <label for="for-expire_seconds" class="form-label">Status</label>
                                        <div class="input-group">
                                            <select class="form-control" name="status"  title="Status">
                                                <option value="">All</option>
                                                <option value="ENABLED" {{ (request()->query('status') == 'ENABLED') ? 'selected' : '' }}>ENABLED</option>
                                                <option value="DISABLED" {{ (request()->query('status') == 'DISABLED') ? 'selected' : '' }}>DISABLED</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col mb-2">
                                        <label for="for-expire_seconds" class="form-label">Suspended</label>
                                        <div class="input-group">
                                            <select class="form-control" name="suspended"  title="Suspended">
                                                <option value="">All</option>
                                                <option value="NO" {{ (request()->query('suspended') == 'NO') ? 'selected' : '' }}>NO</option>
                                                <option value="YES" {{ (request()->query('suspended') == 'YES') ? 'selected' : '' }}>YES</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col mt-1 justify-content-around" >
                                        <button class="btn btn-info m-3 ms-auto btn-sm" type="submit">serach</button>
                                        <button class="btn btn-secondary m-3 ms-auto btn-sm" type="button" onclick="resetForm('feildWiseSearchForm')"><i class="fa fa-refresh" aria-hidden="true"></i></button>   
                                    </div>
                                </div>
                                </form>
                            </div>
                            <!-- search end -->
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
                    <table data-toggle="table" data-show-columns="false" data-buttons-class="xs btn-light" class="tablesaw table mb-0" data-tablesaw-mode="stack">
                        <thead class="table-light">
                            <tr>
                                <th>Go To</th>
                                <th>Account Number</th>
                                <th>Account Type</th>
                                <th>Name</th>
                                <th>Company Name</th>
                                <th>Phone Number</th>
                                <th>Balance</th>
                                <th>Agent Code</th>
                                <th>Status</th>
                                <th>Is Suspended</th>
                                <th class="action-text-left">Action</th>
                            </tr>
                        </thead>
                                        
                        <tbody>
                            @foreach ($tenants as $key => $tenant)
                                <tr>
                                    <td><a  href=""><i class="fa fa-window-minimize" aria-hidden="true"  title="Go To Account" style="margin-left: 12px;"></i></a></td>
                                    <td><a  href="">{{$tenant->account_number}}</a></td>
                                    <td>{{ $tenant->billplan->type}}</td>
                                    <td>{{ $tenant->first_name.' '.$tenant->last_name }}</td>
                                    <td><a  href="">{{$tenant->company_name}}</a></td>
                                    <td>{{ $tenant->phone_number }}</td>
                                    <td>{{ ($tenant->billplan->type == "PREPAID") ? "$".$tenant->effective_balance : "$".$tenant->balance }}</td>
                                    <td><a  href=""><i class="fa fa-repeat" aria-hidden="true"  title="Assign Agent" style="margin-left: 34px;"></i></a></td>
                                    @if($tenant->status == "ENABLED")
                                    <td><span class="badge bg-success">ENABLED</span></td>
                                    @else
                                    <td><span class="badge bg-danger">DISABLED</span></td>
                                    @endif
                                    @if($tenant->suspended == "YES")
                                    <td><a href="{{-- route('tenant.changesuspended',$tenant->id) --}}" onclick="return confirm('You want to activate this tenant account ?');"><span class="badge bg-success">YES</span></a></td>
                                    @else
                                    <td><a href="{{-- route('tenant.changesuspended',$tenant->id) --}}" onclick="return confirm('You want to suspend this tenant account ?');"><span class="badge bg-danger">NO</span></a></td>
                                    @endif
                                 
                                    <td class="action-text-left">
                                        @if ($operationPermission['update']) <a  href="{{ route('tenant.edit',$tenant->id) }}"><i class="fa-solid fa-pen-to-square" title="Edit"></i></a> 
                                         <a href="{{ route('tenant.resetpassword',$tenant->id) }}" ><i class="fa fa-link" title="Reset Password"></i></a>@endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @include('include.pagination',['data' => $tenants])
                </div>
            </div> 
        </div> 
    </div>
</div>        
@endsection

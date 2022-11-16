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
                             <h4 class="page-title"><i class="fa fa-users" aria-hidden="true"></i> Agents</h4>
                        </div>
                         <div class="col-md-6 pull-right mb-1">
                            @if ($operationPermission['create'])
                                <a class="btn btn-primary btn-sm" href="{{ route('agent.create') }}" title="Add New Agent"><i class="fa fa-plus"></i></a>
                            @endif
                                <a class="btn btn-info btn-sm" data-bs-toggle="collapse" href="#searchSection" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-search"></i></a>
                            </div>
                            <!-- search start -->
                            <div class="collapse @if(request()->query('account_code') != '' || request()->query('firstname') != '' || request()->query('company_name') != '' || request()->query('status') != '' || request()->query('suspended') != '')show @endif" id="searchSection">
                                <form action="{{ route('agent.index') }}" method="GET" name="feildWiseSearchForm" class="feildWiseSearchForm" id="feildWiseSearchForm">    
                                <div class="row">
                                    <div class="col mb-2 ">
                                        <label for="for-gatway" class="form-label">Agent Code</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="account_code" id="account_code" placeholder="Agent Code" value="{{ request()->query('account_code') }}" autocomplete=off>
                                        </div>
                                    </div>

                                    <div class="col mb-2 ">
                                        <label for="for-gatway" class="form-label">Name</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Name" value="{{ request()->query('firstname') }}" autocomplete=off>
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
                                                <option value="ACTIVE" {{ (request()->query('status') == 'ACTIVE') ? 'selected' : '' }}>ACTIVE</option>
                                                <option value="INACTIVE" {{ (request()->query('status') == 'INACTIVE') ? 'selected' : '' }}>INACTIVE</option>
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
                                <th>Agent Code</th>
                                <th>Name</th>
                                <th>Company Name</th>
                                <th>Email</th>
                                <th>Balance</th>
                                <th>Status</th>
                                <th>Suspended</th>
                                <th>Commission</th>
                                <th>Tenant</th>
                                <th class="action-text-left">Action</th>
                            </tr>
                        </thead>
                                        
                        <tbody>
                            @foreach ($agents as $key => $agent)
                                <tr>
                                    <td><a  href=""><i class="fa fa-window-minimize" aria-hidden="true"  title="Go To Account" style="margin-left: 12px;"></i></a></td>
                                    <td>{{ $agent->account_code }}</td>
                                    <td>{{ $agent->firstname.' '.$agent->lastname }}</td>
                                    <td>{{ $agent->company_name }}</td>
                                    <td>{{ $agent->email }}</td>
                                    <td>{{ '$'.$agent->balance }}</td>
                                    @if($agent->status == "ACTIVE")
                                    <td><a href="{{ route('agent.changestatus',$agent->id) }}" onclick="return confirm('You want to deactivate this agent account ?');"> <span class="badge bg-success">ACTIVE</span></a></td>
                                    @else
                                    <td><a href="{{ route('agent.changestatus',$agent->id) }}" onclick="return confirm('You want to activate this agent account ?');"><span class="badge bg-danger">INACTIVE</span></a></td>
                                    @endif
                                    @if($agent->suspended == "YES")
                                    <td><a href="{{ route('agent.changesuspended',$agent->id) }}" onclick="return confirm('You want to activate this agent account ?');"><span class="badge bg-success">YES</span></a></td>
                                    @else
                                    <td><a href="{{ route('agent.changesuspended',$agent->id) }}" onclick="return confirm('You want to suspend this agent account ?');"><span class="badge bg-danger">NO</span></a></td>
                                    @endif
                                    <td><a  href="{{ route('agentCommission.index',$agent->id) }}" style="margin-left: 35px;" title="Agent Commission"><i class="fa fa-usd" aria-hidden="true"></i></a></td>
                                    <td><a  href="{{ route('agent.viewtenant',$agent->id) }}" style="margin-left: 20px;" title="View Tenant"><i class="fa fa-users" aria-hidden="true"></i></a></td>
                                    <td class="action-text-left">
                                        @if ($operationPermission['update']) <a  href="{{ route('agent.edit',$agent->id) }}"><i class="fa-solid fa-pen-to-square" title="Edit"></i></a> 
                                         <a href="{{ route('agent.resetpassword',$agent->id) }}" ><i class="fa fa-link" title="Reset Password"></i></a>@endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @include('include.pagination',['data' => $agents])
                </div>
            </div> 
        </div> 
    </div>
</div>        
@endsection

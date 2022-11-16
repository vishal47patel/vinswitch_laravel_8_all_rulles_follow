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
                             <h4 class="page-title"><i class="fa fa-users" aria-hidden="true"></i> View Tenant</h4>
                        </div>
                        <div class="col-md-6 pull-right mb-1">
                            <a class="btn-sm btn-primary" href="{{ route('agent.index') }}"><i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <!-- header end-->

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
                                <th>Status</th>
                                <th>Is Suspended</th>
                            </tr>
                        </thead>
                                        
                        <tbody>
                            @foreach ($tenants as $key => $tenant)
                                <tr>
                                    <td><a  href=""><i class="fa fa-window-minimize" aria-hidden="true"  title="Go To Account" style="margin-left: 12px;"></i></a></td>
                                    <td>{{-- $agent->account_code --}}</td>
                                    <td>{{-- $agent->account_code --}}</td>
                                    <td>{{ $tenant->first_name.' '.$tenant->last_name }}</td>
                                    <td>{{ $tenant->company_name }}</td>
                                    <td>{{ $tenant->phone_number }}</td>
                                    <td>{{ '$'.$tenant->balance }}</td>
                                    @if($tenant->status == "ACTIVE")
                                    <td><span class="badge bg-success">ACTIVE</span></td>
                                    @else
                                    <td><span class="badge bg-danger">INACTIVE</span></td>
                                    @endif
                                    @if($tenant->suspended == "YES")
                                    <td><a href="{{ route('agent.tenantchangesuspended',$tenant->agent_id) }}"><span class="badge bg-success">YES</span></a></td>
                                    @else
                                    <td><a href="{{ route('agent.tenantchangesuspended',$tenant->agent_id) }}"><span class="badge bg-danger">NO</span></a></td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                   {{-- @include('include.pagination',['data' => $tenants]) --}}
                </div>
            </div> 
        </div> 
    </div>
</div>        
@endsection

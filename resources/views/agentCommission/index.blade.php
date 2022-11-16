@extends('layouts.main')
@section('content')
<?php 
if ($agent->balance > 0.00) {
    $class = 'green';
}else if ($agent->balance < 0.00) {
    $class = 'red';
}else{
    $class = 'aqua';
}

?>
<div class="container-fluid"><br>                    
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">

                    <!-- header start-->
                    <div class="row with-border mb-2">
                        <div class="col-md-6">
                             <h4 class="page-title"><i class="fa fa-object-group" aria-hidden="true"></i>  Manage Commission of Agent {{ $agent->firstname.' '.$agent->lastname }}</h4>
                        </div>
                         <div class="col-md-6 pull-right">
                            <a class="btn btn-primary" href="{{ route('agentCommission.create',$id) }}"> Make Payment</a>
                            <a class="btn btn-primary" href="{{ route('agent.index') }}"><i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <!-- header end-->
                   
                    <!-- search start -->
                    <form action="{{ route('agentCommission.index',$id) }}" method="GET" name="feildWiseSearchForm" class="feildWiseSearchForm" id="feildWiseSearchForm">    
                        <div class="row">
                            <div class="col-lg-2 mb-2">                                    
                                <label for="example-date" class="form-label">To Date</label>
                                <input class="form-control" type="date" name="start_date" id="start_date" value="{{request()->query('start_date')}}">
                            </div>

                            <div class="col-lg-2 mb-2">
                                <label for="example-date" class="form-label">From Date</label>
                                <input class="form-control" type="date" name="end_date" id="end_date" value="{{request()->query('end_date')}}">
                            </div>
                            <div class="col-lg-3 mt-3">
                                <button class="btn btn-primary" type="submit" id="search">Search</button>
                                <button class="btn btn-secondary" type="button" onclick="resetForm('feildWiseSearchForm')"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                            </div>
                            <div class="form-group col-md-4" style="margin-left: 93px;">
                            <div class="info-box bg-{{$class}}">
                                <span class="info-box-icon">$</span>
                                <div class="info-box-content">
                                    &nbsp;
                                    <span class="info-box-text">Balance</span>
                                    <span class="info-box-number">{{ '$ '.$agent->balance }}</span>
                                </div>
                            </div>
                            </div>
                        </div>
                    </form>
                    <!-- search end -->
                  <br>
                    @include('layouts.flash_message') 
                    <div class="row">
                        <div class="col-md-6">            
                            @include('include.length_menu')
                        </div>
                    </div>       
                    <table data-toggle="table" data-show-columns="false" data-buttons-class="xs btn-light" class="tablesaw table mb-0" data-tablesaw-mode="stack">
                        <thead class="table-light">
                            <tr>
                                <th>Tenant</th>
                                <th>Summary</th>
                                <th>Amount</th>
                                <th>Commission Percentage(%)</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Balance</th>
                                <th>Created Date</th>
                            </tr>
                        </thead>
                                        
                        <tbody>
                            @foreach ($agentcommissions as $key => $agentcommission)
                                <tr>
                                    <td>{{ !empty($agentcommission->tenant_account_number) ? $agentcommission->tenant_account_number." - ".$agentcommission->tenantAccountNumber->company_name : "-"}}</td>
                                    <td>{{ $agentcommission->summary }}</td>
                                    <td>{{ "$".$agentcommission->amount }}</td>
                                    <td>{{ $agentcommission->commission_percentage }}</td>
                                    <td>{{ "$".$agentcommission->debit }}</td>
                                    <td>{{ "$".$agentcommission->credit }}</td>
                                    <td>{{ "$".$agentcommission->balance }}</td>
                                    <td>{{ $agentcommission->created_date }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @include('include.pagination',['data' => $agentcommissions])
                </div>
            </div> 
        </div> 
    </div>
</div>       
@endsection

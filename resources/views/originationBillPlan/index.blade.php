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
                             <h4 class="page-title"><i class="fa fa-paste" aria-hidden="true"></i> Origination Bill Plan</h4>
                        </div>
                         <div class="col-md-6 pull-right mb-1">
                            @if ($operationPermission['create'])
                                <a class="btn btn-primary btn-sm" href="{{ route('originationBillPlan.create') }}" title="Add New Origination Bill Plan"><i class="fa fa-plus"></i></a>
                            @endif
                         <a class="btn btn-info btn-sm" data-bs-toggle="collapse" href="#searchSection" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-search"></i></a>
                        </div>
                        <!-- search start -->
                        <div class="collapse @if(request()->query('bill_plan_type') != '' || request()->query('bill_plan_name') != '' || request()->query('origination_rate_plan') != '' || request()->query('origination_enable') != '')show @endif" id="searchSection">
                            <form action="{{ route('originationBillPlan.index') }}" method="GET" name="feildWiseSearchForm" class="feildWiseSearchForm" id="feildWiseSearchForm">    
                            <div class="row">
                    
                                <div class="col mb-2">
                                    <label for="for-expire_seconds" class="form-label">Bill Plan Type</label>
                                    <div class="input-group">
                                        <select class="form-control" name="bill_plan_type"  title="Status">
                                            <option value="">Select Bill Type</option>
                                            <option value="POSTPAID" {{ (request()->query('bill_plan_type') == 'POSTPAID') ? 'selected' : '' }}>POSTPAID</option>
                                            <option value="PREPAID" {{ (request()->query('bill_plan_type') == 'PREPAID') ? 'selected' : '' }}>PREPAID</option>
                                        </select>
                                    </div>
                                </div>

                                 <div class="col mb-2 ">
                                    <label for="for-gatway" class="form-label">Bill Plan Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="bill_plan_name" id="bill_plan_name" placeholder="Bill Plan Name" value="{{ request()->query('bill_plan_name') }}" autocomplete=off>
                                    </div>
                                </div>

                                <div class="col mb-2">
                                    <label for="for-expire_seconds" class="form-label">Status</label>
                                    <div class="input-group">
                                         <select class="form-control" name="origination_rate_plan"  title="Origination Rate Plan">
                                      <option disabled="" selected>Select Origination Rate Plan</option>
                                       @foreach ($OriginationRatePlans as $OriginationRatePlan)
                                        <option value="{{$OriginationRatePlan->id}}" {{ (request()->query('origination_rate_plan') == $OriginationRatePlan->id) ? 'selected' : '' }}>{{$OriginationRatePlan->name}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>

                                <div class="col mb-2">
                                    <label for="for-expire_seconds" class="form-label">Status</label>
                                    <div class="input-group">
                                        <select class="form-control" name="origination_enable"  title="Status">
                                            <option value="">All</option>
                                            <option value="ACTIVE" {{ (request()->query('origination_enable') == 'ACTIVE') ? 'selected' : '' }}>ACTIVE</option>
                                            <option value="INACTIVE" {{ (request()->query('origination_enable') == 'INACTIVE') ? 'selected' : '' }}>INACTIVE</option>
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
                                <th>Bill Plan Type</th>
                                <th>Bill Plan Name</th>
                                <th>Origination Rate Plan</th>
                                <th>Status</th>
                                <th>Description</th>
                                <th class="action-text-left">Action</th>
                            </tr>
                        </thead>
                                        
                        <tbody>
                            @foreach ($OriginationBillPlans as $key => $OriginationBillPlan)
                                <tr>
                                    <td>{{ $OriginationBillPlan->bill_plan_type }}</td>
                                    <td>{{ $OriginationBillPlan->bill_plan_name }}</td>
                                    <td>{{ $OriginationBillPlan->originationBillPlan->name }}</td>
                                    @if($OriginationBillPlan->origination_enable == "ACTIVE")
                                    <td><a href="{{ route('originationBillPlan.changestatus',$OriginationBillPlan->id) }}" onclick="return confirm('You want to deactivate this Bill Plan account ?');"><span class="badge bg-success">ACTIVE</span></a></td>
                                    @else
                                    <td><a href="{{ route('originationBillPlan.changestatus',$OriginationBillPlan->id) }}" onclick="return confirm('You want to activate this Bill Plan account ?');"><span class="badge bg-danger">INACTIVE</span></a></td>
                                    @endif
                                    <td>{{ $OriginationBillPlan->description }}</td>

                                    <td class="action-text-left">
                                        @if ($operationPermission['update']) <a  href="{{ route('originationBillPlan.edit',$OriginationBillPlan->id) }}"><i class="fa-solid fa-pen-to-square" title="Edit"></i></a> @endif
                                        @if ($operationPermission['delete']) <a href="{{ route('originationBillPlan.destroy',$OriginationBillPlan->id) }}" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa-solid fa-trash-can" title="Delete"></i></a> @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @include('include.pagination',['data' => $OriginationBillPlans])
                </div>
            </div> 
        </div> 
    </div>
</div>        
@endsection

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
                                        @if ($operationPermission['delete']) <a href="{{ route('originationBillPlan.destroy',$OriginationBillPlan->id) }}" onclick="return confirm('Are you sure you want to delete this role?');"><i class="fa-solid fa-trash-can" title="Delete"></i></a> @endif
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

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
                             <h4 class="page-title"><i class="fa fa-paste" aria-hidden="true"></i> Termination Bill Plan</h4>
                        </div>
                         <div class="col-md-6 pull-right mb-1">
                            @if ($operationPermission['create'])
                            <a class="btn btn-primary btn-sm" href="{{ route('billPlan.create') }}" title="Add New Termination Bill Plan"><i class="fa fa-plus"></i></a>
                            @endif
                            <a class="btn btn-info btn-sm" data-bs-toggle="collapse" href="#searchSection" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-search"></i></a>
                        </div>
                        <!-- search start -->
                        <div class="collapse @if(request()->query('name') != '' || request()->query('type') != '' || request()->query('status') != '')show @endif" id="searchSection">
                            <form action="{{ route('billPlan.index') }}" method="GET" name="feildWiseSearchForm" class="feildWiseSearchForm" id="feildWiseSearchForm">    
                            <div class="row">
                                <div class="col mb-2 ">
                                    <label for="for-gatway" class="form-label">Plan Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value="{{ request()->query('name') }}" autocomplete=off>
                                    </div>
                                </div>

                                <div class="col mb-2">
                                    <label for="for-expire_seconds" class="form-label">Type</label>
                                    <div class="input-group">
                                        <select class="form-control" name="type"  title="Status">
                                            <option value="">All</option>
                                            <option value="POSTPAID" {{ (request()->query('type') == 'POSTPAID') ? 'selected' : '' }}>POSTPAID</option>
                                            <option value="PREPAID" {{ (request()->query('type') == 'PREPAID') ? 'selected' : '' }}>PREPAID</option>
                                        </select>
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
                    <table data-toggle="table" data-show-columns="false" data-buttons-class="xs btn-light"  class="tablesaw table mb-0" data-tablesaw-mode="stack">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Monthly Payment</th>
                                <th>Monthly Minutes</th>
                                <th>Status</th>
                                <th class="action-text-left">Action</th>
                            </tr>
                        </thead>
                                        
                        <tbody>
                            @foreach ($billplans as $key => $billplan)
                                <tr>
                                    <td>{{ $billplan->name }}</td>
                                    <td>{{ $billplan->type }}</td>
                                    <td>{{ $billplan->monthly_payment }}</td>
                                    <td>{{ $billplan->monthly_mins }}</td>
                                    @if($billplan->status == "ACTIVE")
                                    <td><a href="{{ route('billPlan.changestatus',$billplan->id) }}"><span class="badge bg-success">ACTIVE</span></a></td>
                                    @else
                                    <td><a href="{{ route('billPlan.changestatus',$billplan->id) }}"><span class="badge bg-danger">INACTIVE</span></a></td>
                                    @endif

                                    <td class="action-text-left">
                                        @if ($operationPermission['update']) <a  href="{{ route('billPlan.edit',$billplan->id) }}"><i class="fa-solid fa-pen-to-square" title="Edit"></i></a> @endif
                                        @if($billplan->deleteVisibility($billplan->id))
                                            @if ($operationPermission['delete']) <a href="{{ route('billPlan.destroy',$billplan->id) }}" onclick="return confirm('Are you sure you want to delete this role?');"><i class="fa-solid fa-trash-can" title="Delete"></i></a> @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @include('include.pagination',['data' => $billplans])
                </div>
            </div> 
        </div> 
    </div>
</div>        
@endsection

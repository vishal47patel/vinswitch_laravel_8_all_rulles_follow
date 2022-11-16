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
                             <h4 class="page-title"><i class="fa fa-object-group" aria-hidden="true"></i> Termination Rate Plan</h4>
                        </div>
                         <div class="col-md-6 pull-right mb-1">
                            @if ($operationPermission['create'])
                                <a class="btn btn-primary btn-sm" href="{{ route('sofiaRateplan.create') }}" title="Add Nw Termination Rate Plan"><i class="fa fa-plus"></i></a>
                                <a class="btn btn-info btn-sm" data-bs-toggle="collapse" href="#searchSection" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-search"></i></a>
                            @endif
                        </div>
                        <!-- search start -->
                        <div class="collapse @if(request()->query('plan_name') != '' || request()->query('status') != '')show @endif" id="searchSection">
                            <form action="{{ route('sofiaRateplan.index') }}" method="GET" name="feildWiseSearchForm" class="feildWiseSearchForm" id="feildWiseSearchForm">    
                            <div class="row">
                                <div class="col mb-2">
                                    <label for="for-gatway" class="form-label">Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="plan_name" id="plan_name" placeholder="Enter Plan Name" value="{{ request()->query('plan_name') }}" autocomplete=off>
                                    </div>

                                </div>

                                <div class="col mb-2">
                                    <label for="for-expire_seconds" class="form-label">Status</label>
                                    <div class="input-group">
                                        <select class="form-control" name="status"  title="Status">
                                            <option value="">Select All</option>
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
                                <th>Plan Name</th>
                                <th>Concurrent Call</th>
                                <th>Max Call Length</th>
                                <th>Status</th>
                                <th>Termination Rate</th>
                                <th class="action-text-left">Action</th>
                            </tr>
                        </thead>
                                        
                        <tbody>
                            @foreach ($sofiarateplans as $key => $sofiarateplan)
                                <tr>
                                    <td>{{ $sofiarateplan->plan_name }}</td>
                                    <td>{{ $sofiarateplan->cc }}</td>
                                    <td>{{ $sofiarateplan->max_call_length }}</td>
                                    @if($sofiarateplan->status == "ACTIVE")
                                    <td><a href="{{ route('sofiaRateplan.changestatus',$sofiarateplan->id) }}"><span class="badge bg-success">ACTIVE</span></a></td>
                                    @else
                                    <td><a href="{{ route('sofiaRateplan.changestatus',$sofiarateplan->id) }}"><span class="badge bg-danger">INACTIVE</span></a></td>
                                    @endif 
                                    <td><a  href="{{ route('sofiaRate.index',$sofiarateplan->id) }}" style="margin-left: 60px;" title="View Rate"><i class="fa fa-usd" aria-hidden="true"></i></a></td>

                                    <td class="action-text-left">
                                        <a  href="{{ route('sofiaRateplan.show',$sofiarateplan->id) }}"><i class="fa-solid fa-eye" title="View"></i></a>
                                        @if ($operationPermission['update']) <a  href="{{ route('sofiaRateplan.edit',$sofiarateplan->id) }}"><i class="fa-solid fa-pen-to-square" title="Edit"></i></a> @endif
                                        @if ($operationPermission['delete']) <a href="{{ route('sofiaRateplan.destroy',$sofiarateplan->id) }}"  onclick="return confirm('Are you sure you want to delete this Plan?');"><i class="fa-solid fa-trash-can" title="Delete"></i></a> @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @include('include.pagination',['data' => $sofiarateplans])
                </div>
            </div> 
        </div> 
    </div>
</div>         
@endsection

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
                             <h4 class="page-title"><i class="fa fa-paste" aria-hidden="true"></i> Termination Rates : {{$sofiarateplan->plan_name}}</h4>
                        </div>
                         <div class="col-md-6 pull-right mb-1">
                                <a class="btn btn-danger btn-sm" href="{{ route('sofiaRate.rate_export') }}" title="Export"><i class="fa fa-download" aria-hidden="true"></i></a>
                                <a class="btn btn-success btn-sm" href="{{ route('sofiaRate.import',$sofiarateplan->id) }}" title="Import"><i class="fa fa-upload" aria-hidden="true"></i></a>
                                @if ($operationPermission['create'])
                                <a class="btn btn-info btn-sm" href="{{ route('sofiaRate.create',$sofiarateplan->id) }}" title="Add New Rate"><i class="fa fa-plus"></i></a>
                                @endif
                                <a class="btn btn-secondary btn-sm search-button" title="Advance Search"><i class="fa fa-search" aria-hidden="true"></i></a>
                                <a class="btn btn-primary btn-sm" href="{{ route('sofiaRateplan.index') }}" ><i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <!-- header end-->

                    <div class="row">
                        <div class="col-md-8">
                            
                            <div class="row search-form" style="display: none;">
                                <div class="col-md-4">            
                                    @include('include.length_menu')
                                </div>
                                <div class="col-md-8">
                                    @include('include.search')
                                </div>
                            </div> 
                             @include('layouts.flash_message')          
                            <table data-toggle="table" data-show-columns="false" data-buttons-class="xs btn-light" class="tablesaw table mb-0" data-tablesaw-mode="stack">
                                <thead class="table-light">
                                    <tr>
                                        <th>Code</th>
                                        <th>Description</th>
                                        <th>Buy Rate</th>
                                        <th>Sell Rate(%)</th>
                                        <th>Sell Rate</th>
                                        <th class="action-text-left">Action</th>
                                    </tr>
                                </thead>
                                                
                                <tbody>
                                    @foreach ($SofiaRates as $key => $SofiaRate)
                                        <tr>
                                            <td>{{ $SofiaRate->code }}</td>
                                            <td>{{ $SofiaRate->description }}</td>
                                            <td>{{ "$".$SofiaRate->buy_rate }}</td>
                                            <td>{{ $SofiaRate->sale_percentage}}</td>
                                            <td>{{ "$".$SofiaRate->sale_rate}}</td>

                                            <td class="action-text-left">
                                                @if ($operationPermission['update']) <a  href="{{ route('sofiaRate.edit',$SofiaRate->id) }}"><i class="fa-solid fa-pen-to-square" title="Edit"></i></a> @endif
                                                @if ($operationPermission['delete']) <a href="{{ route('sofiaRate.destroy',$SofiaRate->id) }}"  onclick="return confirm('Are you sure you want to delete this role?');"><i class="fa-solid fa-trash-can" title="Delete"></i></a> @endif
                                            </td>
                                        </tr>
                                    @endforeach 
                                </tbody>
                            </table>
                            @include('include.pagination',['data' => $SofiaRates])
                        </div>

                        <div class="col-md-4">       
                            <table data-toggle="table" data-show-columns="false" data-buttons-class="xs btn-light" class="tablesaw table mb-0" data-tablesaw-mode="stack">
                                <thead class="table-light">
                                    <tr>
                                        <th>File Name</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                                
                                <tbody>
                                    @foreach ($FailedRateFiles as $key => $FailedRateFile)
                                        <tr>
                                            <td><a  href="{{ route('sofiaRate.downloadFailedCsv',$FailedRateFile->id) }}">{{ $FailedRateFile->file_name }}</a></td>
                                            <td>{{ $FailedRateFile->created_at }}</td>
                                            <td class="action-text-left">
                                                @if ($operationPermission['delete']) <a href="{{ route('sofiaRate.deleteFailedCsv',$FailedRateFile->id) }}"  onclick="return confirm('Are you sure you want to delete this role?');"><i class="fa-solid fa-trash-can" title="Delete"></i></a> @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @include('include.pagination',['data' => $SofiaRates])
                        </div>
                    </div>

                </div>
            </div> 
        </div>
    </div>
</div>       
@endsection


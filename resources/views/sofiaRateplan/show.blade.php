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
                             <h4 class="page-title"><i class="fa fa-object-group" aria-hidden="true"></i> View Termination RatePlan ( {{$SofiaRateplan->plan_name}} )</h4>
                        </div>
                         <div class="col-md-6 pull-right mb-1">
                            <a class="btn btn-primary btn-sm" href="{{ route('sofiaRateplan.index') }}"><i class="fa fa-arrow-left"></i></a>
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
                                <th>Gateway</th>
                                <th>Priority</th>
                            </tr>
                        </thead>
                                        
                        <tbody>
                            @foreach ($SofiaPlangateways as $key => $SofiaPlangateway)
                                <tr>
                                    <td>{{ $SofiaPlangateway->gateway->gateway_name }}</td>
                                    <td>{{ $SofiaPlangateway->priority }}</td>
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

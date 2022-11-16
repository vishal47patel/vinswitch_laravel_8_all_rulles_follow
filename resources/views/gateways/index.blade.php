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
                            <h4 class="page-title"><i class="far fa-dot-circle" aria-hidden="true"></i> Gateway List</h4>
                        </div>
                        <div class="col-md-6 pull-right mb-1">
                            @if ($operationPermission['create'])
                            <a class="btn btn-primary btn-sm" href="{{ route('gateways.create') }}" title="Add New Gateway"><i class="fa fa-plus"></i></a>
                            @endif
                            <a class="btn btn-info btn-sm" data-bs-toggle="collapse" href="#searchSection" role="button" aria-expanded="false" aria-controls="collapseExample" title="Advance Search"><i class="fas fa-search"></i></a>
                        </div>
                        <div class="collapse @if(request()->query('gateway_name') != '' || request()->query('hostname') != '' || request()->query('register') != '')show @endif" id="searchSection">
                            <div class="card card-body">
                                <form action="{{ route('gateways.index') }}" method="GET" name="feildWiseSearchForm" class="feildWiseSearchForm" id="feildWiseSearchForm">
                                    
                                    <div class="row">
                                        <div class="col mb-2 ">
                                            <label for="for-gatway" class="form-label">Gateway Name</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="far fa-dot-circle"></i></span>
                                                <input type="text" class="form-control" name="gateway_name" id="gateway_name" placeholder="Enter Gateway Name" value="{{ request()->query('gateway_name') }}" autocomplete=off>
                                            </div>

                                        </div>

                                        <div class="col mb-2">
                                            <label for="for-prefix" class="form-label">Register</label>
                                            <div class="input-group">

                                                <span class="input-group-text"><i class="far fa-keyboard"></i></span>
                                                <select class="select2-multiple1 form-control" name="register" title="Select Register" id="register">
                                                    <option value="">Select</option>
                                                    <option value="TRUE" {{ (request()->query('register') == 'TRUE') ? 'selected' : '' }}>TRUE</option>
                                                    <option value="FALSE" {{ (request()->query('register') == 'FALSE') ? 'selected' : '' }}>FALSE</option>
                                                </select>
                                            </div>

                                        </div>

                                        <div class="col mb-2 ">
                                            <label for="for-Hostname" class="form-label">Hostname </label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class=" fab fa-odnoklassniki"></i></span>
                                                <input type="text" class="form-control" name="hostname" id="hostname" placeholder="Enter Hostname" value="{{ request()->query('hostname') }}" autocomplete=off />
                                            </div>
                                        </div>

                                        <div class="col mb-2 justify-content-around" align="right">
                                           
                                                <button class="btn btn-secondary m-3 ms-auto" type="button" onclick="resetForm('feildWiseSearchForm')" title="Reset Form"><i class="fa fa-refresh" aria-hidden="true" ></i></button>
                                                <button class="btn btn-info m-3 ms-auto" type="submit" title="Search"><i class="fas fa-search"></i></button>
                                                
                                            
                                        </div>

                                    </div>
                                </form>
                            </div>
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
                                <th class="id-text-left">#</th>
                                <th>Gateway Name</th>
                                <th>Expire Seconds</th>
                                <th>Retry Seconds</th>
                                <th class="text-center">Register</th>
                                <th>Hostname</th>
                                <th class="text-center">Default Outbound Gateway</th>
                                <th class="action-text-left">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($gateways as $key => $gateway)
                            <tr>
                                <td class="id-text-left">{{ ($gateways->currentpage()-1) * $gateways->perpage() + $key + 1 }}</td>
                                <td>{{ $gateway->gateway_name }}</td>
                                <td>{{ $gateway->expire_seconds }}</td>
                                <td>{{ $gateway->retry_seconds }}</td>
                                @if($gateway->register == "TRUE")
                                <td><a href="{{ route('gateways.changeType',$gateway->id) }}" title="Change Register Status"><span class="badge badge-soft-success" >{{$gateway->register}}</span></a></td>
                                @else
                                <td><a href="{{ route('gateways.changeType',$gateway->id) }}" title="Change Register Status"><span class="badge badge-soft-danger" >{{$gateway->register}}</span></a></td>
                                @endif
                                <td>{{ $gateway->hostname }}</td>
                                @if($gateway->outbound_default == "YES")
                                <td><a href="{{ route('gateways.changeDefault',$gateway->id) }}" title="Change Default Outbound Status"><span class="badge badge-soft-success" >{{$gateway->outbound_default}}</span></a></td>
                                @else
                                <td><a href="{{ route('gateways.changeDefault',$gateway->id) }}" title="Change Default Outbound Status"><span class="badge badge-soft-danger" >{{$gateway->outbound_default}}</span></a></td>
                                @endif
                                <td class="action-text-left">
                                    @if ($operationPermission['update']) <a href="{{ route('gateways.edit',$gateway->id) }}"><i class="fa-solid fa-pen-to-square" title="Edit"></i></a> @endif
                                    @if ($operationPermission['delete']) <a href="{{ route('gateways.destroy',$gateway->id) }}" onclick="return confirm('Are you sure you want to delete this Gateways?');"><i class="fa-solid fa-trash-can text-danger" title="Delete"></i></a> @endif
                                </td>
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
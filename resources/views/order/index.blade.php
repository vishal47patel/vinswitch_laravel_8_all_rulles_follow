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
                            <h4 class="page-title"><i class="fa fa-building" aria-hidden="true"></i> Customer Orders</h4>
                        </div>
                        <div class="col-md-6 pull-right mb-1">
                          
                            <a class="btn btn-info btn-sm" data-bs-toggle="collapse" title="Search" href="#searchSection" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-search"></i></a>
                        </div>
                        <div class="collapse @if(request()->query('datetime') != '' || request()->query('end_date') != '' || request()->query('account_number') != '' || request()->query('type') != '' || request()->query('status') != '' )show @endif" id="searchSection">
                            <div class="card card-body">
                                <form action="{{ route('order.index') }}" method="GET" name="feildWiseSearchForm" class="feildWiseSearchForm" id="feildWiseSearchForm">
                                    <div class="row">
                                       
                                        <div class="col mb-2 ">
                                            <label for="for-gatway" class="form-label">Start Date</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="far fa-keyboard" aria-hidden="true"></i></span>
                                                <input type="date" class="form-control" name="datetime" id="example-date" placeholder="Enter Start Date" value="{{ request()->query('datetime') }}" autocomplete=off>
                                            </div>
                                        </div>
                                        <div class="col mb-2 ">
                                            <label for="for-gatway" class="form-label">End Date</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="far fa-keyboard" aria-hidden="true"></i></span>
                                                <input type="date" class="form-control" name="end_date" id="example-date" placeholder="Enter End Date" value="{{ request()->query('end_date') }}" autocomplete=off>
                                            </div>
                                        </div>
                                      
                                        @if(isset(Auth::user()->role) && Auth::user()->role == 'ADMIN')
                                        <div class="col mb-2 ">
                                            <label for="for-gatway" class="form-label">Tenant</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="far fa-keyboard" aria-hidden="true"></i></span>
                                                
                                                <select class="form-control"  name="tenant_account_no"  title="tenant account number" id="tenant_account_no">
                                                <option value="">Select</option>
                                                @foreach ($users as $key)
                                                    <option value='{{ @$key->account_number  }}'>{{ @$key->account_number ."-". $key->company_name }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                       @endif
                                       <div class="col mb-2 ">
                                            <label for="for-gatway" class="form-label">Type</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="far fa-keyboard" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control" name="type" id="type" placeholder="Enter type" value="{{ request()->query('type') }}" autocomplete=off>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="col mb-2">
                                            <label for="for-prefix" class="form-label">Status</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa fa-user-plus" aria-hidden="true"></i></span>
                                                <select class="form-control" name="status" title="status">
                                                    <option value="">Select</option>
                                                    <option value="COMPLETED" {{ (request()->query('status') == 'COMPLETED') ? 'selected' : '' }}>COMPLETED</option>
                                                    <option value="CONFIRM" {{ (request()->query('status') == 'CONFIRM') ? 'selected' : '' }}>CONFIRM</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col mb-2"></div>
                                        <div class="col mb-2 justify-content-around" align="right">
                                            <button class="btn btn-secondary m-3 ms-auto btn-sm" type="button"  title="Reset" onclick="resetForm('feildWiseSearchForm')"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                                            <button class="btn btn-info m-3 ms-auto btn-sm" type="submit" title="Search"><i class="fas fa-search"></i></button>
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
                            <th>Order No.</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Tenant</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($orders as $key => $order)
                        <tr>
                            <td class="id-text-left">{{ ($orders->currentpage()-1) * $orders->perpage() + $key + 1 }}</td>
                            <td><a  href="{{ route('order.show',$order->id) }}"  title="order view"><b># </b>{{ $order->order_no }}</a></td>
                            <td>{{ $order->type }}</td>
                            <td>{{ "$".$order->amount }}</td>
                            <td>{{ date("M d, Y",strtotime($order->datetime)) }}</td>
                            <td>{{ @$order->account_no->account_number ." - ". @$order->account_no->company_name}}</td>
                            <td>{{ $order->status }}</td>

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
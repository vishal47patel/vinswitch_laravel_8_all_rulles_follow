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
                            <h4 class="page-title"><i class="fa fa-credit-card" aria-hidden="true"></i> Customer Payment Logs</h4>
                        </div>
                        <div class="col-md-6 pull-right mb-1">
                            @if ($operationPermission['create'])
                            <a class="btn btn-success btn-sm bg-success" href="{{ route('payments.creditdebit') }}" title="Debit/Credit" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <!--<i class="fab fa-amazon-pay text-white"></i>--> Debit/Credit</i>
                            </a>
                            <a class="btn btn-primary btn-sm " href="{{ route('payments.create') }}" title="Add Payment"><i class="fa fa-plus"></i></a>
                            @endif
                            <a class="btn btn-info btn-sm" data-bs-toggle="collapse" href="#searchSection" role="button" aria-expanded="false" aria-controls="collapseExample" title="Advance Search"><i class="fas fa-search"></i></a>


                        </div>
                        <div class="collapse @if(request()->query('date') != '' || request()->query('account_number') != '' || request()->query('status') != '' )show @endif" id="searchSection">
                            <div class="card card-body">
                                <form action="{{ route('payments.index') }}" method="GET" name="feildWiseSearchForm" class="feildWiseSearchForm" id="feildWiseSearchForm">

                                    <div class="row">
                                        <div class="col-lg-3 mb-2  ">
                                            <label for="for-gatway" class="form-label">Payment Date</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="far fa-dot-circle"></i></span>
                                                <input type="text" class="form-control" name="date" id="date" placeholder="Enter Number Name" value="{{ request()->query('date') }}" autocomplete=off>
                                            </div>

                                        </div>

                                        <div class="col-lg-3 mb-2 ">
                                            <label for="for-account_number" class="form-label">Payment</label>
                                            <div class="input-group">

                                                <span class="input-group-text"><i class="far fa-keyboard"></i></span>
                                                <select class="select2-multiple1 form-control" name="account_number" title="Service Type" id="account_number">
                                                    <option value="">Select</option>
                                                    @foreach($tenant as $data)
                                                    <option value="{{$data->account_number}}" @if($data->account_number == request()->query('account_number')) selected @endif >{{$data->account_number}} - {{$data->company_name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-lg-3 mb-2 ">
                                            <label for="for-Status" class="form-label">Status</label>
                                            <div class="input-group">

                                                <span class="input-group-text"><i class="far fa-keyboard"></i></span>
                                                <select class="select2-multiple1 form-control" name="status" id="status1">
                                                    <option value="">ALL</option>
                                                    <option value="Completed" @if("Completed"==request()->query('status')) selected @endif>Completed</option>
                                                    <option value="Canceled-Reversal" @if("Canceled-Reversal"==request()->query('status')) selected @endif>Canceled-Reversal</option>
                                                    <option value="Denied" @if("Denied"==request()->query('status')) selected @endif>Denied</option>
                                                    <option value="Expired" @if("Expired"==request()->query('status')) selected @endif>Expired</option>
                                                    <option value="Failed" @if("Failed"==request()->query('status')) selected @endif>Failed</option>
                                                    <option value="In-Progress" @if("In-Progress"==request()->query('status')) selected @endif>In-Progress</option>
                                                    <option value="Partially-Refunded" @if("Partially-Refunded"==request()->query('status')) selected @endif>Partially-Refunded</option>
                                                    <option value="Pending" @if("Pending"==request()->query('status')) selected @endif>Pending</option>
                                                    <option value="Refunded" @if("Refunded"==request()->query('status')) selected @endif>Refunded</option>
                                                    <option value="Reversed" @if("Reversed"==request()->query('status')) selected @endif>Reversed</option>
                                                    <option value="Processed" @if("Processed"==request()->query('status')) selected @endif>Processed</option>
                                                    <option value="Voided" @if("Voided"==request()->query('status')) selected @endif>Voided</option>

                                                </select>
                                            </div>

                                        </div>

                                        <div class="col-lg-3 mb-2 justify-content-around" align="right">

                                            <button class="btn btn-secondary m-3 ms-auto" type="button" onclick="resetForm('feildWiseSearchForm')" title="Reset Form"><i class="fa fa-refresh" aria-hidden="true"></i></button>
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
                                <th>#</th>
                                <th>Payment Date</th>
                                <th>Amount</th>
                                <th>Paypal Fees</th>
                                <th>Final Amount</th>
                                <th>Payment</th>
                                <th class="text-center">Status</th>
                                <th>Payment Method</th>
                                <th class="action-text-left">Reference Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($record as $key => $data)
                            <tr>
                                <td class="id-text-left">{{ ($record->currentpage()-1) * $record->perpage() + $key + 1 }}</td>
                                <td>{{ $data->date }}</td>
                                <td>{{ $data->amount }}</td>
                                <td>{{ $data->paypal_fees }}</td>
                                <td>{{ $data->final_amount }}</td>
                                <td>{{ $data->account_number }} - {{ $data->tenant->company_name }}</td>
                                <td class="text-center">

                                    <span @if($data->status == 'Unapplied') class="badge badge-soft-danger" @elseif($data->status == 'Closed') class="badge badge-soft-warning" @else class="badge badge-soft-success" @endif >{{ $data->status }}</span>

                                </td>

                                <td>{{ $data->payment_method }}</td>
                                <td class="action-text-left">
                                    {{ $data->reference_number }}
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


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Credit/Debit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="check_validation" id="check_validation">
                    @csrf
                    <div class="row">

                        <div class="col-lg-12 mb-2 ">
                            <label for="for-account_number" class="form-label">Tenant <span class="text-red"> *</span></label>
                            <div class="input-group">

                                <span class="input-group-text"><i class="far fa-keyboard"></i></span>
                                <select class="select2-multiple1 form-control" name="account_number" title="Service Type" id="account_number">
                                    <option value="">Select</option>
                                    @foreach($tenant as $data)
                                    <option value="{{$data->account_number}}" >{{$data->account_number}} - {{$data->company_name}}</option>
                                    @endforeach

                                </select>
                            </div>

                        </div>
                        <div class="col-lg-12 mb-2 ">
                            <label for="for-Status" class="form-label">Type <span class="text-red"> *</span></label>
                            <div class="input-group">

                                <span class="input-group-text"><i class="far fa-keyboard"></i></span>
                                <select class="select2-multiple1 form-control" name="status" id="status1">
                                    <option value="">Select Type</option>
                                    <option value="DEBIT">DEBIT</option>
                                    <option value="CREDIT">CREDIT</option>

                                </select>
                            </div>

                        </div>
                        <div class="col-lg-12 mb-2  ">
                            <label for="for-gatway" class="form-label">Amount <span class="text-red"> *</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="far fa-dot-circle"></i></span>
                                <input type="text" class="form-control number" name="date" id="date" placeholder="Enter Number Name" value="" autocomplete=off>
                            </div>

                        </div>
                        <div class="col-lg-12 mb-2  ">
                            <label for="for-gatway" class="form-label">Summary <span class="text-red"> *</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="far fa-dot-circle"></i></span>
                                <input type="text" class="form-control" name="summary" id="summary" placeholder="Enter summary" value="" autocomplete=off>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary add-debit-credit">Add</button>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/payments.js') }}" defer></script>
<script type="text/javascript" defer>
    $(document).ready(function() {

        
        $("body").on('click', '.add-debit-credit', function(e) {
            
            // if ($("#check_validation").valid() == true) {                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: "{{ route('payments.creditdebit') }}",
                    data: $('#check_validation').serialize(),
                    success: function(result) {                        

                    },
                    error: function() {}
                });
            // }

        });

    });
</script>

@endsection
@extends('layouts.main')

@section('content')
<div class="container-fluid"><br>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <!-- header start-->
                    <div class="row with-border mb-2">
                        <div class="col-md-6">
                            <h4 class="page-title"><i class="fas fa-paste" aria-hidden="true"></i> Add Number Detail</h4>
                        </div>
                        <div class="col-md-6 pull-right mb-1">
                            <a class="btn btn-primary" href="{{ route('payments.index') }}" title="Back"><i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <!-- header end-->

                    <form action="{{ route('payments.store') }}" method="POST" id="check_validation_did_numbers">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4 mb-2 validation_message ">
                                <label for="for-account_number" class="form-label">Vendor Name<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="far fa-keyboard"></i></span>
                                    <select class="select2-multiple1 form-control" name="account_number" id="account_number">
                                        <option value="">Select</option>
                                        @foreach($tenant as $data)
                                        <option value="{{$data->account_number}}" @if($data->account_number == old('account_number')) selected @endif >{{$data->account_number}} - {{$data->company_name}}</option>
                                        @endforeach

                                    </select>
                                </div>

                                @error('account_number')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                           

                            <div class="col-lg-4 mb-2 validation_message">
                                <label for="for-date" class="form-label">Payment Date <span class="text-red"> *</span></label>
                                <div class="input-group">

                                    <span class="input-group-text"><i class="far fa-keyboard"></i></span>
                                    <input onfocus="(this.type='date')" class="form-control" name="date" id="example-date" placeholder="YYYY-MM-DD" value="2022-11-22" autocomplete=off />
                                </div>

                                @error('date')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>


                        

                            <div class="col-lg-4 mb-2 validation_message">
                                <label for="for-payment_method" class="form-label">Payment Method <span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class=" fab fa-odnoklassniki"></i></span>


                                    <select class="select2-multiple1 form-control" name="payment_method" title="Payment Method" id="payment_method">
                                        <option value="">Select Payment Method</option>
                                        <option value="CASH" @if("CASH"==old('payment_method')) selected @endif>CASH</option>
                                        <option value="CHEQUE" @if("CHEQUE"==old('payment_method')) selected @endif>CHEQUE</option>
                                        <option value="WIRE" @if("WIRE"==old('payment_method')) selected @endif>WIRE</option>
                                        <option value="VISA" @if("VISA"==old('payment_method')) selected @endif>VISA</option>
                                        <option value="MASTERCARD" @if("MASTERCARD"==old('payment_method')) selected @endif>MASTERCARD</option>
                                    </select>
                                </div>
                                @error('payment_method')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>
                            <div class="col-lg-4 mb-2 validation_message">
                                <label for="for-from_user" class="form-label">Amount</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                                    <input type="text" class="form-control number" name="amount" id="amount" placeholder="Enter Amount" value="{{ old('amount') }}" autocomplete=off />
                                </div>

                                @error('amount')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>
                            <div class="col-lg-4 mb-2 validation_message">
                                <label for="for-from_user" class="form-label">Reference Number <span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                                    <input type="text" class="form-control" name="reference_number" id="reference_number" placeholder="Enter Reference Number" value="{{ old('reference_number') }}" autocomplete=off />
                                </div>

                                @error('reference_number')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <button class="btn btn-primary float-end" type="submit" title="Add Record">Add</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<script src="{{ asset('js/payments.js') }}" defer></script>
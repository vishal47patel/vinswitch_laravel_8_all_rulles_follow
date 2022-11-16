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
                             <h4 class="page-title"><i class="fa fa-cog" aria-hidden="true"></i>  Make payment to agent {{ $agent->firstname.' '.$agent->lastname }}</h4>
                        </div>
                         <div class="col-md-6 pull-right mb-1">
                            <a class="btn btn-primary" href="{{ route('agentCommission.index',$id) }}"><i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <!-- header end-->
                        
                    <form action="{{ route('agentCommission.store',$id) }}" method="POST" id="check_validation" class="parsley-examples">
                    @csrf
                        <div class="row">
                            <div class="col-lg-4 mb-2">                                    
                                <label for="simpleinput" class="form-label">Payment Date <span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <input class="form-control" id="payment_date" type="date" name="payment_date" value="{{ date('Y-m-d') }}">
                                </div>
                                @error('payment_date')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-4 mb-2">
                                <label for="example-email" class="form-label">Amount <span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount" value="{{ old('amount') }}" autocomplete = off>
                                </div>
                                @error('amount')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>
                            <div class="col-lg-4 mb-2"></div>

                            <div class="col-lg-4 mb-2">
                                <label for="example-password" class="form-label">Payment Method <span class="text-red"> *</span></label>
                                <select class="form-control" name="payment_method"  title="Type" id="payment_method">
                                    <option disabled selected>Select Payment Method</option>
                                    @foreach ($payments as $payment)
                                    <option value="{{$payment}}" {{ old('payment_method') == $payment ? 'selected' : '' }}>{{$payment}}</option>
                                    @endforeach
                                </select>
                                @error('payment_method')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-4 mb-2">
                                <label for="example-password" class="form-label">Reference Number <span class="text-red"> *</span></label>
                                <div class="input-group multipleselect">
                                    <input type="text" class="form-control" name="reference_number" id="name" placeholder="Reference Number" value="{{ old('reference_number') }}" autocomplete = off >
                                </div>
                                @error('reference_number')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                        </div>
                        <button class="btn btn-primary" type="submit" id="submit_btn">Submit</button>
                    </form>
                        
                </div> 
            </div> 
        </div>
    </div>
</div> 

@endsection
<script src="{{ asset('js/validation.js') }}" defer></script>



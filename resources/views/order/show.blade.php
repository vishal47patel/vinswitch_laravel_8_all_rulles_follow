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
                            <h4 class="page-title"><i class="fa fa-globe" aria-hidden="true"></i> Order Type : {{ $orders->type }}</h4>
                        </div>
                        <div class="col-md-6 pull-right mb-1">
                            <a class="btn btn-primary" href="{{ route('order.index') }}" title="Back"><i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <!-- header end-->
                    <div class="row invoice-info">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">
                        
                        </div>
                        <div class="col-sm-4 " style="text-align: right;">
                            <b>Order # {{ $orders->order_no}}</b>
                            <p>Date : {{ date("M d, Y",strtotime($orders->datetime)) }}</p>       
                        </div>
                     </div>
                      <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Description</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th style="text-align: right;">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td>{{ $summary->description}}</td>
                                        <td>{{ date("M d, Y",strtotime($orders->datetime)) }}</td>
                                        <td>{{ $orders->end_date}}</td>
                                        <td style="text-align: right;">{{ $summary->rate}}</td>
                                       
                                    </tr>
                                
                                </tbody>
                        </table>
                        </div>
                    </div>
                    <div class="row">
                <!-- accepted payments column -->
                <div class="col-xs-6">
                    
                </div>
                <!-- /.col -->
                <div class="col-xs-6">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th style="text-align: right;">Total</th>
                                    <td style="text-align: right;">$ {{ $orders->amount}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
<script src="{{ asset('js/validation.js') }}" defer></script>
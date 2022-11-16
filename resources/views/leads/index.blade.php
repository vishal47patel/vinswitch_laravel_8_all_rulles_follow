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
                             <h4 class="page-title"><i class="fa fa-bars" aria-hidden="true"></i> Lead List</h4>
                        </div>
                         <div class="col-md-6 pull-right mb-1">
                            <a class="btn btn-primary btn-sm" onclick="show_div();" title="Import"><i class="fa fa-upload" id="import"></i></a>
                            <a class="btn btn-secondary btn-sm" href="{{ route('leads.export') }}" title="Export"><i class="fa fa-download"></i></a>
                        </div>
                    </div>
                    <!-- header end-->

                    <!-- import lead start -->
                    <div class="box-header">
                        <form method="POST" action="{{ route('leads.import') }}" name="form" id="form" enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-3 form-pull-right" style="display: none;" id="display_import">
                            <input type="file" class="form-control" name="lead_file" id="lead_file">
                            <p class="validation_error">@error('lead_file'){{ $message }} @enderror</p>
                            <button type="submit" class="btn btn-primary btn-sm">save</button>
                        </div>
                        </form>
                    </div>
                    <!-- import lead end -->
                    
                    @include('layouts.flash_message')            
                    <table data-toggle="table" data-show-columns="false" data-buttons-class="xs btn-light" class="tablesaw table mb-0" data-tablesaw-mode="stack">
                        @include('include.length_menu')
                        @include('include.search')
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Country</th>
                                <th>Telephone code</th>
                                <th>Contact No</th>
                            </tr>
                        </thead>
                                        
                        <tbody>
                            @foreach ($leads as $key => $lead)
                                <tr>
                                    <td>{{ $lead->first_name. ' ' . $lead->last_name }}</td>
                                    <td>{{ $lead->email }}</td>
                                    <td>{{ $lead->country }}</td>
                                    <td>{{ $lead->tel_code }}</td>
                                    <td>{{ $lead->contact_no }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @include('include.pagination',['data' => $leads])
                </div>
            </div> 
        </div> 
    </div>
</div>  
<script type="text/javascript">
function show_div() {
    $('#display_import').show(); //to show
}
</script>
@endsection


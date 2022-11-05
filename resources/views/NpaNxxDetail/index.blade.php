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
                             <h4 class="page-title"><i class="fa fa-paste" aria-hidden="true"></i> NpaNxxMaster List</h4>
                        </div>
                         <div class="col-md-6 pull-right mb-1">
                        
                         @if ($operationPermission['import'])
                            <a class="btn btn-success btn-sm" href="{{ route('NpaNxxDetail.import',request('id')) }}"><i class="fa fa-cloud-upload"></i></a>
                         @endif
                            <a class="btn btn-primary btn-sm" href="{{ route('npaNxxMaster.index') }}"><i class="fa fa-arrow-left"></i></a>
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
                                <th class="id-text-left">State</th>
                                <th>NPA/NXX</th>
                                <th>Lata</th>
                                <th>Zipcode</th>
                                <th>Zipcode Count</th>
                                <th>Zipcode Freq</th>
                                <th>NPA</th>
                                <th>NXX</th>
                                <th class="action-text-left">Action</th>
                            </tr>
                        </thead>
                                        
                        <tbody>
                            @foreach ($NpaNxxDetail as $key => $npaNxx)
                                <tr>
                                <td>{{ $npaNxx->state }}</td>
                                    <td>{{ $npaNxx->npanxx }}</td>
                                    <td>{{ $npaNxx->lata }}</td>
                                    <td>{{ $npaNxx->zipcode }}</td>
                                    <td>{{ $npaNxx->zipcode_count }}</td>
                                    <td>{{ $npaNxx->zipcode_freq }}</td>
                                    <td>{{ $npaNxx->npa }}</td>
                                    <td>{{ $npaNxx->nxx }}</td>
                                    <td class="action-text-left">
                                    @if ($operationPermission['delete'])<a href="{{ route('NpaNxxDetail.destroy',$npaNxx->id) }}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this NpaNxxDetail?');"><i class="fa-solid fa-trash-can" title="Delete"></i></a>@endif
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

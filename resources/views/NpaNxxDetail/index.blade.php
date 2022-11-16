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
                            <a class="btn btn-success btn-sm" title="Import" href="{{ route('NpaNxxDetail.import',request('id')) }}"><i class="fa fa-cloud-upload"></i></a>
                         @endif
                            <a class="btn btn-primary btn-sm" title="Back" href="{{ route('npaNxxMaster.index') }}"><i class="fa fa-arrow-left"></i></a>
                            <a class="btn btn-info btn-sm"  data-bs-toggle="collapse" href="#searchSection" title="Search" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-search"></i></a>
                        </div>
                        <div class="collapse @if(request()->query('state') != '' || request()->query('npanxx') != '' || request()->query('lata') != '' || request()->query('isdefault') != '')show @endif" id="searchSection">
                            <div class="card card-body">
                                <form action="{{ route('NpaNxxDetail.index',$id) }}" method="GET" name="feildWiseSearchForm" class="feildWiseSearchForm" id="feildWiseSearchForm">
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="for-gatway" class="form-label">State</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="far fa-clipboard" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control" name="state" id="state" placeholder="Enter state" value="{{ request()->query('state') }}" autocomplete=off>
                                            </div>
                                        </div>
                                        <div class="col mb-3">
                                            <label for="for-gatway" class="form-label">NPA/NXX</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="far fa-bookmark" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control" name="npanxx" id="npanxx" placeholder="Enter npanxx" value="{{ request()->query('npanxx') }}" autocomplete=off>
                                            </div>
                                        </div>
                                        <div class="col mb-3">
                                            <label for="for-gatway" class="form-label">Lata</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-sliders-h" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control" name="lata" id="lata" placeholder="Enter lata" value="{{ request()->query('lata') }}" autocomplete=off>
                                            </div>
                                        </div>
                                        <div class="col mb-3">
                                            <label for="for-gatway" class="form-label">Zipcode</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-bullseye" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control" name="zipcode" id="zipcode" placeholder="Enter zipcode" value="{{ request()->query('zipcode') }}" autocomplete=off>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="for-gatway" class="form-label">NPA</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="far fa-keyboard" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control" name="npa" id="npa" placeholder="Enter npa" value="{{ request()->query('npa') }}" autocomplete=off>
                                            </div>
                                        </div>
                                        <div class="col mb-3">
                                            <label for="for-gatway" class="form-label">NXX</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="far fa-map" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control" name="nxx" id="nxx" placeholder="Enter nxx" value="{{ request()->query('nxx') }}" autocomplete=off>
                                            </div>
                                        </div>
                                        <div class="col mb-2 justify-content-around" align="right">
                                            <button class="btn btn-secondary m-3 ms-auto btn-sm" type="button" title="Reset" onclick="resetForm('feildWiseSearchForm')"><i class="fa fa-refresh" aria-hidden="true"></i></button>
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
                                    @if ($operationPermission['delete'])<a href="{{ route('NpaNxxDetail.destroy',$npaNxx->id) }}" onclick="return confirm('Are you sure you want to delete this NpaNxxDetail?');"><i class="fa-solid fa-trash-can text-danger" title="Delete"></i></a>@endif
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

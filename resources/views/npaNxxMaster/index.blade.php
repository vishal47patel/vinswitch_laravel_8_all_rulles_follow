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
                            @if ($operationPermission['create'])
                                <a class="btn btn-primary btn-sm" href="{{ route('npaNxxMaster.create') }}" ><i class="fa fa-plus"></i></a>
                            @endif
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
                                <th>Name</th>
                                <th>Default</th>
                                <th class="action-text-left">Action</th>
                            </tr>
                        </thead>
                                        
                        <tbody>
                            @foreach ($npaNxxMaster as $key => $npaNxx)
                                <tr>
                                    <td class="id-text-left">{{ ($npaNxxMaster->currentpage()-1) * $npaNxxMaster->perpage() + $key + 1 }}</td>
                                    <td>{{ $npaNxx->name }}</td>
                                    <td>
                                        @if($npaNxx->isdefault =='YES')
                                        <span class="badge bg-primary">Yes</span>
                                        @else
                                        <span class="badge bg-danger">No</span>
                                        @endif
                                    </td>
                                    <td class="action-text-left">
                                        @if ($operationPermission['update'])<a class="btn btn-primary btn-xs" href="{{ route('npaNxxMaster.edit',$npaNxx->id) }}"><i class="fa-solid fa-pen-to-square" title="Edit"></i></a>@endif
                                        @if ($operationPermission['detail'])<a href="{{ route('npaNxxMaster.show',$npaNxx->id) }}" class="btn btn-success btn-xs"><i class="fa-solid fa-list" title="NPA/NXX List"></i></a>@endif
                                        @if($npaNxx->isdefault =='NO') <a href="{{ route('npaNxxMaster.destroy',$npaNxx->id) }}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this npaNxxMaster?');"><i class="fa-solid fa-trash-can" title="Delete"></i></a> @endif
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

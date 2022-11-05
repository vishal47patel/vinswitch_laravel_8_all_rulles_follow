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
                             <h4 class="page-title"><i class="fa fa-cog" aria-hidden="true"></i> Role List</h4>
                        </div>
                         <div class="col-md-6 pull-right mb-1">
                             @if ($operationPermission['create'])
                                    <a class="btn btn-primary btn-sm" href="{{ route('roles.create') }}" ><i class="fa fa-plus"></i></a>
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
                    <table data-toggle="table" data-show-columns="false" data-buttons-class="xs btn-light" class="tablesaw table mb-0" data-tablesaw-mode="stack">
                        <thead class="table-light">
                            <tr>
                                <th class="id-text-left">#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th class="action-text-left">Action</th>
                            </tr>
                        </thead>
                                        
                        <tbody>
                            @foreach ($roles as $key => $role)
                                <tr>
                                    <td class="id-text-left">{{ ($roles->currentpage()-1) * $roles->perpage() + $key + 1 }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->description }}</td>
                                    <td class="action-text-left">
                                        @if ($operationPermission['update']) <a href="{{ route('roles.edit',$role->id) }}"><i class="fa-solid fa-pen-to-square" title="Edit"></i></a> @endif
                                        @if ($operationPermission['delete']) <a href="{{ route('roles.destroy',$role->id) }}"  onclick="return confirm('Are you sure you want to delete this role?');"><i class="fa-solid fa-trash-can" title="Delete"></i></a> @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @include('include.pagination',['data' => $roles])
                </div>
            </div> 
        </div> 
    </div>
</div>           
@endsection

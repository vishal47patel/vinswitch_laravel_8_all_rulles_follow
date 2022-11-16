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
                             <h4 class="page-title"><i class="fa fa-user" aria-hidden="true"></i> User List</h4>
                        </div>
                         <div class="col-md-6 pull-right mb-1">
                            @if ($operationPermission['create'])
                            <a class="btn btn-primary btn-sm" href="{{ route('users.create') }}" ><i class="fa fa-plus"></i></a>
                            @endif
                         <a class="btn btn-info btn-sm" data-bs-toggle="collapse" href="#searchSection" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-search"></i></a>
                        </div>
                        <!-- search start -->
                        <div class="collapse @if(request()->query('firstname') != '' || request()->query('email') != '' || request()->query('role_id') != '')show @endif" id="searchSection">
                            <form action="{{ route('billPlan.index') }}" method="GET" name="feildWiseSearchForm" class="feildWiseSearchForm" id="feildWiseSearchForm">    
                            <div class="row">
                                <div class="col mb-2 ">
                                    <label for="for-gatway" class="form-label">Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Name" value="{{ request()->query('firstname') }}" autocomplete=off>
                                    </div>
                                </div>

                                <div class="col mb-2 ">
                                    <label for="for-gatway" class="form-label">Email</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="{{ request()->query('email') }}" autocomplete=off>
                                    </div>
                                </div>

                                <div class="col mb-2">
                                    <label for="for-expire_seconds" class="form-label">Type</label>
                                    <div class="input-group">
                                        <select class="form-control"  name="role_id"  title="Role" id="role_id" >
                                        <option disabled="" selected>Select Role</option>
                                        @foreach ($roles as $role)
                                        <option value="{{$role->id}}" {{ (request()->query('role_id') == $role->id) ? 'selected' : '' }}>{{$role->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col mt-1 justify-content-around" >
                                    <button class="btn btn-info m-3 ms-auto btn-sm" type="submit">serach</button>
                                    <button class="btn btn-secondary m-3 ms-auto btn-sm" type="button" onclick="resetForm('feildWiseSearchForm')"><i class="fa fa-refresh" aria-hidden="true"></i></button>   
                                </div>
                            </div>
                            </form>
                        </div>
                        <!-- search end -->
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
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th class="action-text-left">Action</th>
                            </tr>
                        </thead>
                                        
                        <tbody>
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td class="id-text-left">{{ ($users->currentpage()-1) * $users->perpage() + $key + 1 }}</td>
                                    <td>{{ $user->firstname. ' ' . $user->lastname }}</td>
                                    <td>{{ $user->phoneno }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->hasRole->name }}</td>
                                    <td class="action-text-left">
                                        @if ($operationPermission['update'])<a href="{{ route('users.edit',$user->id) }}"><i class="fa-solid fa-pen-to-square" title="Edit"></i></a>@endif
                                        @if ($operationPermission['delete'])<a href="{{ route('users.destroy',$user->id) }}"  onclick="return confirm('Are you sure you want to delete this user?');"><i class="fa-solid fa-trash-can" title="Delete"></i></a>@endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @include('include.pagination',['data' => $users])
                </div>
            </div> 
        </div> 
    </div>
</div>           
@endsection

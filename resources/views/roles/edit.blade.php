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
                             <h4 class="page-title"><i class="fa fa-cog" aria-hidden="true"></i> Edit Role Detail</h4>
                        </div>
                         <div class="col-md-6 pull-right mb-1">
                            <a class="btn btn-primary" href="{{ route('roles.index') }}"><i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <!-- header end-->
                        
                    <form action="{{ route('roles.update',$role->id) }}" method="POST" id="check_validation">
                    @csrf
                        <div class="row">
                            <div class="col-lg-6 mb-2">                                    
                                <label for="simpleinput" class="form-label">Name<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value="{{ $role->name }}" autocomplete = off >
                                </div>
                                @error('name')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-6 mb-2">
                                <label for="example-email" class="form-label">Description</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-bars" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="description" id="description" placeholder="Enter Description" value="{{ $role->description }}" autocomplete = off>
                                </div>
                                @error('description')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-6 mb-2">
                                <label for="example-password" class="form-label">Permission<span class="text-red"> *</span></label>
                                <div class="input-group multipleselect">
                                    <span class="input-group-text"><i class="fa fa-check-square" aria-hidden="true"></i></span>
                                    <select class="select2-multiple form-control"  name="permissions[]"  title="permission" id="multiple_permission" multiple="multiple">
                                    @foreach($permissions as $permission)
                                    @if(in_array($permission->id, $permission_list))
                                    <option value="{{$permission->id}}" selected="true">{{$permission->name}}</option>
                                    @else
                                    <option value="{{$permission->id}}">{{$permission->name}}</option>
                                    @endif 
                                    @endforeach
                                    </select>
                                </div>
                                @error('permissions')<p class="validation_error">{{ $message }}</p> @enderror
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Models\Rolepermission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    //redirect to index page
    public function index()
    {
        $row = 10;
        if (request('row') != '')
        $row = request('row');

        $roles = Role::where('id','!=', '1')->orderBy('id', 'DESC');
        
        if (request('search') != '') {
            $roles = $roles->where(function ($query) {
                $query->Where('name', 'like', '%'.request('search').'%');
            });
        }
        $roles = $this->getSearch($roles);
        $roles = $roles->paginate($row); //display 10 records
        $operationPermission = [
            'create' => hasPermission(['role_list','role_create']),
            'update' => hasPermission(['role_list','role_update']),
            'delete' => hasPermission(['role_list','role_delete'])
        ];
        
        return view('roles.index',compact('roles', 'operationPermission'));    
    }

    //redirect to create page
    public function create()
    {
        $permissions = Permission::get();
        return view('roles.create',compact('permissions'));
    }

    //insert data
    public function store(RoleStoreRequest $request)
    {
        $input = $request->all();
        $role = Role::create($input);
        $role->permissions()->attach($request->permissions); //attach to table field

        return redirect()->route('roles.index')->with('success','Role created successfully.');
    }

    //redirect to update page
    public function edit($id)
    {   
        $role = Role::findorfail($id);
        $permissions = Permission::get();

        $permission_list = array_map( function ($permission) { 
            return $permission['id'];
        },$role->permissions->toArray());

        return view('roles.edit',compact('role','permissions','permission_list'));
        
    }

    //update data
    public function update(RoleUpdateRequest $request,$id)
    {

        $role = Role::where('id', $id)->first();
        $role->name = $request->name;
        $role->description = $request->description;
        $role->update();
        $role->permissions()->sync($request->permissions); //replace existing data with new added data
 
        return redirect()->route('roles.index')
                        ->with('success','Role updated successfully');
       
    }
    
    //delete data
    public function destroy($id)
    {    
        $role = Role::find($id)->delete();
        return redirect()->route('roles.index')
                        ->with('success','Role deleted successfully');
    }

    private function getSearch($query)
    {
        if ( request('name') != '' )
        $query = $query->where('name', 'like', '%'.request('name').'%');
        
        return $query; 
    }
}

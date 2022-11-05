<?php 

use Illuminate\Support\Facades\Auth;

function hasPermission($permissions)
{
    if (@Auth::user()->role_id == 1) return true;

	$check_permission = array_map( function ($permission) { 
            return $permission['name'];
        },Auth::user()->hasRole->permissions->toArray());

		foreach ($permissions as $permission)
        {
            if(!in_array($permission, $check_permission))
                return false;
        }

        return true;
}
		
	

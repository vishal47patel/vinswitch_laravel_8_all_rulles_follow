<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class CheckPermission
{
    public function handle(Request $request, Closure $next,$permission)
    {
        if (Auth::user()->role_id == 1) return $next($request);

        $permission_list = explode('|', $permission);
        
        $check_permission = array_map( function ($permission) { 
            return $permission['name'];
        },Auth::user()->hasRole->permissions->toArray());

        foreach ($permission_list as $permission)
        {
            if(!in_array($permission, $check_permission))
                abort('403');
        }
        return $next($request);        
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\PasswordStoreRequest;
use App\Http\Requests\AgentResetPasswordRequest;
use Session;

class UserController extends Controller
{
    public function index()
    {
        $row = 10;
        if (request('row') != '')
        $row = request('row');

        $users = User::where('role_id','!=', '1')->orderBy('id', 'DESC');
        
        if (request('search') != '') {
            $users = $users->search(request('search'), null, true, true)->distinct();
        }

        $operationPermission = [
            'create' => hasPermission(['user_list','user_create']),
            'update' => hasPermission(['user_list','user_update']),
            'delete' => hasPermission(['user_list','user_delete'])
        ];
        $users = $this->getSearch($users);
        $users = $users->paginate($row); //display 10 records
        $roles = Role::where('name','<>','superadmin')->get();
        return view('users.index',compact('users','operationPermission','roles'));    
    }

    public function create()
    {
        $roles = Role::where('name','<>','superadmin')->get();
        return view('users.create',compact('roles'));

    }

    public function store(UserStoreRequest $request)
    {
        $input = $request->except(['password','confirm_password']);
        $input['password'] = Hash::make($request->password);
        $input['role'] = 'ADMIN';
        $input['name'] = $request->firstname.' '.$request->lastname;
        $input['superuser'] = 0;
        User::create($input);

        return redirect()->route('users.index')->with('success','User created successfully.');
    }

    public function edit($id)
    {   
        $user = User::findorfail($id);
        $roles = Role::where('name','<>','superadmin')->get();
        return view('users.edit',compact('user','roles'));
        
    }

    public function update(UserUpdateRequest $request,$id)
    {   
        $input = $request->except(['_token','_method']);
        $input['name'] = $request->firstname.' '.$request->lastname;
        User::where('id',$id)->update($input);

        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
       
    }
    
    public function destroy($id)
    {    
        $user = User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('users.editprofile', compact('user'));
    }

    public function updateProfile(ProfileUpdateRequest $request,$id)
    {
        
        $user = Auth::user();
        $input = $request->except(['_token','_method']);
        User::where('id',$user->id)->update($input);

        return redirect()->route('users.editprofile')
                        ->with('success','Profile has been updated successfully!');
       
    }

    public function changePassword()
    {
        return view('users.changepassword');
    }

    public function submitChangePassword(PasswordStoreRequest $request)
    {
        $user = Auth::user();
        $currentPassword = $request->current_password;
        $newPassword = $request->password;

        //check both passwords
        if (Hash::check($currentPassword, $user->password)) {
            if (Hash::check($newPassword, $user->password)) {
                
                return redirect()->route("users.changepassword")->with('danger','New password can not be same as current password.');

            } else {

                $input = $request->except(['password','confirm_password','current_password','_token','_method']);
                $input['password'] = Hash::make($request->password);
                User::where('id',$user->id)->update($input);
                return redirect()->route('users.changepassword')->with('success','Password has been updated successfully!');
            }
        } 
        else {
            return redirect()->route("users.changepassword")->with('danger','Current Password does not match our records..');
        }



    }

    //Signout
    public function signout() {
        Session::flush();
        Auth::logout();
        return Redirect()->route('login');
    }

    private function getSearch($query)
    {
        if ( request('first_name') != '' )
        $query = $query->where('first_name', 'like', '%'.request('first_name').'%');

        if ( request('email') != '' )
        $query = $query->where('email', 'like', '%'.request('email').'%');
        
        if ( request('role_id') != '' )
        $query = $query->where('role_id', 'like', '%'.request('role_id').'%');
        
        return $query; 
    }

   
}

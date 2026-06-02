<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class RoleController extends Controller
{
     use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Role::class);
    $roles=Role::paginate(10);
        return view('Admin.Roles.index',[
            'roles'=>$roles
        ]);
    }

   
    public function create()
    {
        // $this->authorize('create', Role::class);
         return view('Admin.Roles.create',[
            'role'=>new Role(),
        ]);
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:roles,name',
            'ability'=>'required|array',
        ]);

        $role=Role::createWithAbilities($request);

        return redirect()->route('admin.roles')->with('success','Role Created Successfully');
    }
   
    public function show(Role $role)
    {
        //
    }

  
     public function edit(Role $role)
    {
        $role_abilities=$role->abilities()->pluck('type','ability')->toArray();
        return view('Admin.Roles.edit',[
            'role'=>$role,
            'role_abilities'=>$role_abilities,
        ]);
    }


   public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'=>'required',
            'ability'=>'required|array',
        ]);
        $role->updateWithAbilities($request);
        return redirect()->route('admin.roles')->with('success','Role Updated Successfully');
    }

  
   public function destroy($id)    
    {
       Role::destroy($id);
        return redirect()->route('admin.roles')
        ->with('success','Role deleted successfully');
    }
}

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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:roles,name',
            'ability'=>'required|array',
        ]);

        $role=Role::createWithAbilities($request);

        return redirect()->route('admin.roles')->with('success','Role Created Successfully');
    }
    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
     public function edit(Role $role)
    {
        $role_abilities=$role->abilities()->pluck('type','ability')->toArray();
        return view('Admin.Roles.edit',[
            'role'=>$role,
            'role_abilities'=>$role_abilities,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'=>'required',
            'ability'=>'required|array',
        ]);
        $role->updateWithAbilities($request);
        return redirect()->route('admin.roles')->with('success','Role Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy($id)    
    {
       Role::destroy($id);
        return redirect()->route('admin.roles')
        ->with('danger','Role deleted successfully');
    }
}

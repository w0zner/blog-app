<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();

        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255|unique:roles,name',
            'permissions' => 'required|array|exists:permissions,id'
        ]);

        $role = Role::create($data);

        if ($request->has('permissions')) {
            $role->permissions()->attach($request->permissions);
        }


        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Rol creado con éxito',
            'text' => 'El nuevo rol ha sido agregado.',
            'theme' => 'auto',
        ]);

        return redirect()->route('admin.roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        //$rolePermissions = $role->permissions();//->pluck('id')->toArray();
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        //return $rolePermissions;
        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => 'required|max:255|unique:roles,name,' . $role->id,
        ]);

        $role->update($data);

        if ($request->has('permissions')) {
            $role->permissions()->sync($request->permissions);
        }


        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Rol actualizado con éxito',
            'text' => 'El rol ha sido actualizado.',
            'theme' => 'auto',
        ]);

        return redirect()->route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        session()->flash('swal-flash', [
            'position' => 'top-end',
            'icon' => 'success',
            'title' => 'Rol eliminado con éxito',
            'text' => 'El rol ha sido eliminado.',
            'showConfirmButton' => false,
            'timer' => 1500,
            'theme' => 'auto',
        ]);

        return redirect()->route('admin.roles.index');
    }
}

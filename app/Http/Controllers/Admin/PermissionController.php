<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all();

        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255|unique:permissions,name',
        ]);

        Permission::create($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Permiso creado con éxito',
            'text' => 'El nuevo permiso ha sido agregado.',
            'theme' => 'auto',
        ]);

        return redirect()->route('admin.permissions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        return view('admin.permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $data = $request->validate([
            'name' => 'required|max:255|unique:permissions,name,' . $permission->id,
        ]);

        $permission->update($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Permiso actualizado con éxito',
            'text' => 'Los cambios han sido guardados.',
            'theme' => 'auto',
        ]);

        return redirect()->route('admin.permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        session()->flash('swal-flash', [
            'position' => 'top-end',
            'icon' => 'success',
            'title' => 'Permiso eliminado con éxito',
            'text' => 'El permiso ha sido eliminado.',
            'showConfirmButton' => false,
            'timer' => 1500,
            'theme' => 'auto',
        ]);

        return redirect()->route('admin.permissions.index');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Spatie\Permission\Models\Role;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return ['can:manage users'];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        if($request->has('roles')){
            $user->roles()->attach($request->input('roles', []));
        }   

        session()->flash('swal', [  
            'icon' => 'success',
            'title' => 'Usuario creado con éxito',
            'text' => 'El usuario ha sido creado.',
            'theme' => 'auto',
        ]);

        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $userRoles = $user->roles->pluck('id')->toArray();
        return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id',
        ]);
        if ($request->has('password')) {
            $data['password'] = bcrypt($data['password']);
        }
        $user->update($data);

        $user->roles()->sync($request->input('roles', []));
        

        session()->flash('swal', [  
            'icon' => 'success',
            'title' => 'Usuario actualizado con éxito',
            'text' => 'El usuario ha sido actualizado.',
            'theme' => 'auto',
        ]);

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('swal-flash', [
            'position' => 'top-end',
            'icon' => 'success',
            'title' => 'Usuario eliminado con éxito',
            'text' => 'El usuario ha sido eliminado.',
            'showConfirmButton' => false,
            'timer' => 1500,
            'theme' => 'auto',
        ]);
        return redirect()->route('admin.users.index');
    }
}

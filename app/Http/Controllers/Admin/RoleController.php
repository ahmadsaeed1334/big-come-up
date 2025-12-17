<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $title = "Role";
        $roles = Role::with('permissions')
            ->orderBy('name')
            ->get();

        $permissions = Permission::query()
            ->orderBy('name')
            ->get();

        return view('admin.roles.index', compact('roles', 'permissions', 'title'));
    }

    public function store(Request $request)
    {
        $guard = $request->input('guard_name', 'web');

        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles', 'name')->where('guard_name', $guard),
            ],
            'guard_name' => ['nullable', 'string', 'max:50'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['string'],
        ]);

        $role = Role::create([
            'name' => $data['name'],
            'guard_name' => $guard,
        ]);

        if (!empty($data['permissions'])) {
            $role->syncPermissions($data['permissions']);
        }
        toast_created('Role');
        return redirect()
            ->route('admin.roles.index');
    }

    public function update(Request $request, Role $role)
    {
        $guard = $request->input('guard_name', $role->guard_name ?? 'web');

        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles', 'name')
                    ->ignore($role->id)
                    ->where('guard_name', $guard),
            ],
            'guard_name' => ['nullable', 'string', 'max:50'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['string'],
        ]);

        $role->update([
            'name' => $data['name'],
            'guard_name' => $guard,
        ]);

        $role->syncPermissions($data['permissions'] ?? []);
        toast_updated('Role');
        return redirect()
            ->route('admin.roles.index');
    }

    public function destroy(Role $role)
    {
        try {
            $role->delete();
            toast_deleted('Role');
        } catch (\Throwable $e) {
            toast_error('Unable to delete role. It may be in use.');
        }
        return back();
    }
}

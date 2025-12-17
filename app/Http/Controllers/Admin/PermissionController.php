<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::query()
            ->orderBy('name')
            ->paginate(10);

        return view('admin.permissions.index', compact('permissions'));
    }

    public function store(Request $request)
    {
        $guard = $request->input('guard_name', 'web');

        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('permissions', 'name')->where('guard_name', $guard),
            ],
            // 'guard_name' => ['nullable', 'string', 'max:50'],
        ]);

        // $data['guard_name'] = $guard;

        Permission::create($data);


        toast_created('Permission');

        return redirect()->route('admin.permissions.index');
    }

    public function update(Request $request, Permission $permission)
    {
        $guard = $request->input('guard_name', $permission->guard_name ?? 'web');

        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('permissions', 'name')
                    ->ignore($permission->id)
                    ->where('guard_name', $guard),
            ],
            // 'guard_name' => ['nullable', 'string', 'max:50'],
        ]);

        // $data['guard_name'] = $guard;

        $permission->update($data);

        toast_updated('Permission');

        return redirect()->route('admin.permissions.index');
    }

    public function destroy(Permission $permission)
    {
        try {
            $permission->delete();
            toast_deleted('Permission');
        } catch (\Throwable $e) {
            toast_error('Permission cannot be deleted. It may be in use.');
        }

        return back();
    }
}

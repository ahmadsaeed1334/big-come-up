<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    private function userTypes(): array
    {
        return [
            1 => 'DJ',
            2 => 'Artist',
            3 => 'Producer',
            4 => 'Dancer',
            5 => 'Fan',
            9 => 'Admin',
        ];
    }

    public function index(Request $request)
    {
        $title = "User";

        $query = User::query()->latest();

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%");
            });
        }

        // filter by user_type
        if ($request->filled('user_type')) {
            $query->where('user_type', (int)$request->user_type);
        }

        // filter by status
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'suspended') {
                $query->where('is_active', false);
            }
        }

        // filter by role (Spatie real filter)
        if ($request->filled('role')) {
            $roleName = $request->role;
            $query->whereHas('roles', fn($q) => $q->where('name', $roleName));
        }

        $users = $query->paginate(10)->withQueryString();
        $roles = Role::query()->orderBy('name')->get();

        $types = $this->userTypes();

        return view('admin.users.index', compact('users', 'roles', 'types', 'title'));
    }

    public function create()
    {
        $title = "Create User";
        $roles = Role::query()->orderBy('name')->get();
        $types = $this->userTypes();

        return view('admin.users.create', compact('roles', 'types', 'title'));
    }

    public function store(Request $request)
    {
        $types = array_keys($this->userTypes());

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],

            'role' => ['required', 'string', Rule::exists('roles', 'name')],
            'user_type' => ['required', 'integer', Rule::in($types)],

            'is_active' => ['nullable', 'boolean'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'user_type' => (int)$data['user_type'],
            'is_active' => (bool)($data['is_active'] ?? true),
        ]);

        // Spatie assign
        $user->syncRoles([$data['role']]);

        // snapshot column
        $user->update(['role' => $data['role']]);

        toast_created('User');

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        $title = "Edit User";
        $roles = Role::query()->orderBy('name')->get();
        $types = $this->userTypes();
        $userRole = $user->getRoleNames()->first();

        return view('admin.users.edit', compact('user', 'roles', 'types', 'userRole', 'title'));
    }

    public function update(Request $request, User $user)
    {
        $types = array_keys($this->userTypes());

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],

            // password optional on update
            'password' => ['nullable', 'string', 'min:6'],

            'role' => ['required', 'string', Rule::exists('roles', 'name')],
            'user_type' => ['required', 'integer', Rule::in($types)],

            'is_active' => ['nullable', 'boolean'],
        ]);

        $payload = [
            'name' => $data['name'],
            'email' => $data['email'],
            'user_type' => (int)$data['user_type'],
            'is_active' => (bool)($data['is_active'] ?? $user->is_active),
        ];

        if (!empty($data['password'])) {
            $payload['password'] = $data['password'];
        }

        $user->update($payload);

        $user->syncRoles([$data['role']]);
        $user->update(['role' => $data['role']]);

        toast_updated('User');

        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            toast_deleted('User');
        } catch (\Throwable $e) {
            toast_error('User cannot be deleted right now.');
        }

        return back();
    }

    // ✅ suspend/activate quick action
    public function toggle(User $user)
    {
        $user->update(['is_active' => !$user->is_active]);

        $user->is_active ? toast_updated('User Activated') : toast_updated('User Suspended');

        return back();
    }

    public function show(User $user)
    {
        return redirect()->route('admin.users.edit', $user);
    }
}

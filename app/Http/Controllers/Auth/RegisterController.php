<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'user_type' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type,
            'is_active' => true,
            'email_verified_at' => now(), // Auto verify for now
        ]);

        // Assign role based on user_type
        $role = $this->getRoleByUserType($request->user_type);
        $user->assignRole($role);
        $user->syncPrimaryRole();

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    private function getRoleByUserType($userType)
    {
        $roles = [
            1 => 'admin',
            2 => 'manager',
            3 => 'editor',
            4 => 'user',
        ];

        return $roles[$userType] ?? 'user';
    }
}

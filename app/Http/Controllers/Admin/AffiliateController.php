<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AffiliateController extends Controller
{
    public function index(Request $request)
    {
        $title = "Affiliates";
        $query = Affiliate::query()->with('user')->latest();

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        if ($request->filled('q')) {
            $q = $request->q;
            $query->whereHas('user', function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%");
            })->orWhere('code', 'like', "%{$q}%");
        }

        $affiliates = $query->paginate(10)->withQueryString();

        return view('admin.affiliates.index', compact('affiliates', 'title'));
    }

    public function create()
    {
        $title = "Create Affiliate";
        $users = User::query()->orderBy('name')->get();
        return view('admin.affiliates.create', compact('users', 'title'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users,id', 'unique:affiliates,user_id'],
            'code' => ['nullable', 'string', 'max:50', 'unique:affiliates,code'],
            'commission_rate' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'is_active' => ['nullable', 'boolean'],
            'notes' => ['nullable', 'string'],
        ]);

        $data['code'] = $data['code'] ?: strtoupper(Str::random(8));
        $data['commission_rate'] = $data['commission_rate'] ?? 30;
        $data['is_active'] = (bool)($data['is_active'] ?? true);

        Affiliate::create($data);

        toast_created('Affiliate');

        return redirect()->route('admin.affiliates.index');
    }

    public function edit(Affiliate $affiliate)
    {
        $title = "Edit Affiliate";
        $users = User::query()->orderBy('name')->get();
        return view('admin.affiliates.edit', compact('affiliate', 'users', 'title'));
    }

    public function update(Request $request, Affiliate $affiliate)
    {
        $data = $request->validate([
            'user_id' => [
                'required',
                'exists:users,id',
                Rule::unique('affiliates', 'user_id')->ignore($affiliate->id),
            ],
            'code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('affiliates', 'code')->ignore($affiliate->id),
            ],
            'commission_rate' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'is_active' => ['nullable', 'boolean'],
            'notes' => ['nullable', 'string'],
        ]);

        $data['commission_rate'] = $data['commission_rate'] ?? 30;
        $data['is_active'] = (bool)($data['is_active'] ?? $affiliate->is_active);

        $affiliate->update($data);

        toast_updated('Affiliate');

        return redirect()->route('admin.affiliates.index');
    }

    public function destroy(Affiliate $affiliate)
    {
        try {
            $affiliate->delete();
            toast_deleted('Affiliate');
        } catch (\Throwable $e) {
            toast_error('Affiliate cannot be deleted right now.');
        }

        return back();
    }

    public function show(Affiliate $affiliate)
    {
        return redirect()->route('admin.affiliates.edit', $affiliate);
    }

    public function toggle(Affiliate $affiliate)
    {
        $affiliate->update(['is_active' => !$affiliate->is_active]);

        toast_updated($affiliate->is_active ? 'Affiliate Activated' : 'Affiliate Suspended');

        return back();
    }
}

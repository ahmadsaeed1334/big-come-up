<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class SizeController extends Controller
{
    public function index(Request $request)
    {
        $title = "Sizes";
        $search = $request->get('search');

        $sizes = Size::withCount('products')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();


        return view('admin.sizes.index', compact('sizes', 'title', 'search'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100', 'unique:sizes,name'],
            'code' => ['required', 'string', 'max:10', 'unique:sizes,code']
        ]);

        if ($validator->fails()) {
            toast_error($validator->errors()->first());
            return back();
        }

        Size::create([
            'name' => $request->name,
            'code' => strtoupper($request->code),
            'is_active' => $request->has('is_active') ? 1 : 0
        ]);

        toast_created('Size');
        return redirect()->route('admin.sizes.index');
    }

    public function update(Request $request, Size $size)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('sizes', 'name')->ignore($size->id)
            ],
            'code' => [
                'required',
                'string',
                'max:10',
                Rule::unique('sizes', 'code')->ignore($size->id)
            ],
        ]);

        if ($validator->fails()) {
            toast_error($validator->errors()->first());
            return back();
        }

        $size->update([
            'name' => $request->name,
            'code' => strtoupper($request->code),
            'is_active' => $request->has('is_active') ? 1 : 0
        ]);

        toast_updated('Size');
        return redirect()->route('admin.sizes.index');
    }

    public function destroy(Size $size)
    {
        try {
            $size->delete();
            toast_deleted('Size');
            return redirect()->route('admin.sizes.index');
        } catch (\Throwable $e) {
            toast_error('Unable to delete size. It may be assigned to products.');
            return back();
        }
    }
}

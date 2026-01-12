<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    public function index(Request $request)
    {
        $title = "Colors";
        $search = $request->get('search');

        $colors = Color::withCount('products')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();


        return view('admin.colors.index', compact('colors', 'title', 'search'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100', 'unique:colors,name'],
            'code' => ['required', 'string', 'max:7', 'regex:/^#?([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/']
        ]);

        if ($validator->fails()) {
            toast_error($validator->errors()->first());
            return back();
        }

        $code = $request->code;
        if (!str_starts_with($code, '#')) {
            $code = '#' . $code;
        }

        Color::create([
            'name' => $request->name,
            'code' => $code,
            'is_active' => $request->has('is_active') ? 1 : 0
        ]);

        toast_created('Color'); // 👈 SAME TOAST AS UPDATE
        return redirect()->route('admin.colors.index');
    }

    public function update(Request $request, Color $color)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('colors', 'name')->ignore($color->id)
            ],
            'code' => ['required', 'string', 'max:7', 'regex:/^#?([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
        ]);

        if ($validator->fails()) {
            toast_error($validator->errors()->first());
            return back();
        }

        $code = $request->code;
        if (!str_starts_with($code, '#')) {
            $code = '#' . $code;
        }

        $color->update([
            'name' => $request->name,
            'code' => $code,
            'is_active' => $request->has('is_active') ? 1 : 0
        ]);

        toast_updated('Color'); // 👈 SAME TOP-RIGHT TOAST
        return redirect()->route('admin.colors.index');
    }


    public function destroy(Color $color)
    {
        try {
            $color->delete();

            toast_deleted('Color');
            return redirect()->route('admin.colors.index')->with('success', 'Color deleted successfully!');
        } catch (\Throwable $e) {
            toast_error('Unable to delete color. It may be assigned to products.');
            return back()->with('error', 'Unable to delete color. It may be assigned to products.');
        }
    }
}

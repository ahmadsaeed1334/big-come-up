<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ColorController extends Controller
{
    public function index()
    {
        $title = "Colors";
        $colors = Color::orderBy('name')->get();
        return view('admin.colors.index', compact('colors', 'title'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'code' => ['nullable', 'string', 'max:7', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/']
        ]);

        // Check if color already exists
        $color = Color::where('name', $data['name'])->first();

        if (!$color) {
            $color = Color::create($data);
        }

        // If product_id is provided, attach color to product
        if ($request->has('product_id') && $request->product_id) {
            $product = \App\Models\ArtistsProduct::find($request->product_id);
            if ($product && !$product->colors()->where('colors.id', $color->id)->exists()) {
                $product->colors()->attach($color->id);
            }
        }

        // Check if request is AJAX
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Color added successfully!',
                'color' => [
                    'id' => $color->id,
                    'name' => $color->name,
                    'code' => $color->code
                ]
            ]);
        }

        toast_created('Color');
        return back();
    }


    public function update(Request $request, Color $color)
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('colors', 'name')->ignore($color->id)
            ],
            'code' => ['nullable', 'string', 'max:7', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'is_active' => ['boolean']
        ]);

        $color->update($data);

        toast_updated('Color');
        return back();
    }

    public function destroy(Color $color)
    {
        try {
            $color->delete();
            toast_deleted('Color');
        } catch (\Throwable $e) {
            toast_error('Unable to delete color. It may be assigned to products.');
        }

        return back();
    }
}

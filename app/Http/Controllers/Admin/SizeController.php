<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SizeController extends Controller
{
    public function index()
    {
        $title = "Sizes";
        $sizes = Size::orderBy('code')->get();
        return view('admin.sizes.index', compact('sizes', 'title'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'code' => ['required', 'string', 'max:10']
        ]);

        // Check if size already exists
        $size = Size::where('code', $data['code'])->first();

        if (!$size) {
            $size = Size::create($data);
        }

        // If product_id is provided, attach size to product
        if ($request->has('product_id') && $request->product_id) {
            $product = \App\Models\ArtistsProduct::find($request->product_id);
            if ($product && !$product->sizes()->where('sizes.id', $size->id)->exists()) {
                $product->sizes()->attach($size->id);
            }
        }

        // Check if request is AJAX
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Size added successfully!',
                'size' => $size
            ]);
        }

        toast_created('Size');
        return back()->with('success', 'Size added successfully!');
    }
    public function update(Request $request, Size $size)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'code' => [
                'required',
                'string',
                'max:10',
                Rule::unique('sizes', 'code')->ignore($size->id)
            ],
            'is_active' => ['boolean']
        ]);

        $size->update($data);

        toast_updated('Size');
        return back();
    }

    public function destroy(Size $size)
    {
        try {
            $size->delete();
            toast_deleted('Size');
        } catch (\Throwable $e) {
            toast_error('Unable to delete size. It may be assigned to products.');
        }

        return back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArtistsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ArtistsCategoryController extends Controller
{
    public function index(Request $request)
    {
        $title = "Artist Categories";
        $search = $request->get('search');

        $categories = ArtistsCategory::withCount('products')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('slug', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.artists-categories.index', compact('categories', 'title', 'search'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'unique:artists_categories,name']
        ]);

        if ($validator->fails()) {
            toast_error($validator->errors()->first());
            return back();
        }

        ArtistsCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        toast_created('Artist Category');
        return redirect()->route('admin.artists-categories.index');
    }

    public function update(Request $request, ArtistsCategory $artistsCategory)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('artists_categories', 'name')->ignore($artistsCategory->id)
            ]
        ]);

        if ($validator->fails()) {
            toast_error($validator->errors()->first());
            return back();
        }

        $artistsCategory->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        toast_updated('Artist Category');
        return redirect()->route('admin.artists-categories.index');
    }

    public function destroy(ArtistsCategory $artistsCategory)
    {
        try {
            $artistsCategory->delete();
            toast_deleted('Artist Category');
            return redirect()->route('admin.artists-categories.index');
        } catch (\Throwable $e) {
            toast_error('Unable to delete category. It may have products associated.');
            return back();
        }
    }
}

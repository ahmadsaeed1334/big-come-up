<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArtistsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ArtistsCategoryController extends Controller
{
    public function index()
    {
        $title = "Artist Categories";
        $categories = ArtistsCategory::withCount('products')
            ->orderBy('name')
            ->get();

        return view('admin.artists-categories.index', compact('categories', 'title'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:artists_categories,name']
        ]);

        $data['slug'] = Str::slug($data['name']);

        ArtistsCategory::create($data);

        toast_created('Artist Category');
        return redirect()->route('admin.artists-categories.index');
    }

    public function update(Request $request, ArtistsCategory $artistsCategory)
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('artists_categories', 'name')->ignore($artistsCategory->id)
            ]
        ]);

        $data['slug'] = Str::slug($data['name']);

        $artistsCategory->update($data);

        toast_updated('Artist Category');
        return redirect()->route('admin.artists-categories.index');
    }

    public function destroy(ArtistsCategory $artistsCategory)
    {
        try {
            $artistsCategory->delete();
            toast_deleted('Artist Category');
        } catch (\Throwable $e) {
            toast_error('Unable to delete category. It may have products associated.');
        }

        return back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ArtistController extends Controller
{
    public function index()
    {
        $title = "Artists";
        $artists = Artist::withCount('products')
            ->with(['media' => function ($query) {
                $query->where('collection_name', 'profile_image');
            }])
            ->orderBy('name')
            ->get();

        return view('admin.artists.index', compact('artists', 'title'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:artists,name'],
            'bio' => ['required', 'string'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120']
        ]);

        $artist = Artist::create($data);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $artist->addMedia($request->file('image'))
                ->toMediaCollection('profile_image');
        }

        toast_created('Artist');
        return redirect()->route('admin.artists.index');
    }

    public function update(Request $request, Artist $artist)
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('artists', 'name')->ignore($artist->id)
            ],
            'bio' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120']
        ]);

        $artist->update($data);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $artist->clearMediaCollection('profile_image');
            $artist->addMedia($request->file('image'))
                ->toMediaCollection('profile_image');
        }

        toast_updated('Artist');
        return redirect()->route('admin.artists.index');
    }

    public function destroy(Artist $artist)
    {
        try {
            // Delete profile image
            $artist->clearMediaCollection('profile_image');

            $artist->delete();
            toast_deleted('Artist');
        } catch (\Throwable $e) {
            toast_error('Unable to delete artist. It may have products associated.');
        }

        return back();
    }
}

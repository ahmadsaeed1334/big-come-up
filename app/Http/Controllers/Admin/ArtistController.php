<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ArtistController extends Controller
{
    public function index(Request $request)
    {
        $title = "Artists";
        $search = $request->get('search');

        $artists = Artist::withCount('products')
            ->with(['media' => function ($query) {
                $query->where('collection_name', 'profile_image');
            }])
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('bio', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();


        return view('admin.artists.index', compact('artists', 'title', 'search'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'unique:artists,name'],
            'bio' => ['required', 'string'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120']
        ]);

        if ($validator->fails()) {
            toast_error($validator->errors()->first());
            return back();
        }

        $artist = Artist::create([
            'name' => $request->name,
            'bio' => $request->bio,
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $artist->addMedia($request->file('image'))
                ->toMediaCollection('profile_image');
        }

        toast_created('Artist');
        return redirect()->route('admin.artists.index');
    }

    public function update(Request $request, Artist $artist)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('artists', 'name')->ignore($artist->id)
            ],
            'bio' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120']
        ]);

        if ($validator->fails()) {
            toast_error($validator->errors()->first());
            return back();
        }

        $artist->update([
            'name' => $request->name,
            'bio' => $request->bio,
        ]);

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
            return redirect()->route('admin.artists.index');
        } catch (\Throwable $e) {
            toast_error('Unable to delete artist. It may have products associated.');
            return back();
        }
    }
}

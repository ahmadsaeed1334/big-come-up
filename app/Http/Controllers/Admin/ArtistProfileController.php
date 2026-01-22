<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ArtistProfile;
use Illuminate\Http\Request;

class ArtistProfileController extends Controller
{
    public function index(Request $request)
    {
        $title = "Artists";

        $query = User::query()
            ->whereHas('roles', fn($q) => $q->where('name', 'artist'))
            ->latest();

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('username', 'like', "%{$q}%");
            });
        }

        $artists = $query->paginate(10)->withQueryString();

        return view('admin.artists-profile.index', compact('artists', 'title'));
    }

    public function edit(User $artist)
    {
        abort_unless($artist->hasRole('Artist'), 404);

        $profile = ArtistProfile::firstOrCreate(
            ['user_id' => $artist->id],
            ['is_public' => true, 'allow_messages' => true]
        );

        $title = "Edit Artist";
        return view('admin.artists-profile.edit', compact('artist', 'profile', 'title'));
    }

    public function update(Request $request, User $artist)
    {
        abort_unless($artist->hasRole('Artist'), 404);

        $data = $request->validate([
            'bio' => ['nullable', 'string'],
            'location_city' => ['nullable', 'string', 'max:255'],
            'location_country' => ['nullable', 'string', 'max:255'],
            'is_public' => ['nullable', 'boolean'],
            'allow_messages' => ['nullable', 'boolean'],
            'social_links' => ['nullable', 'array'],
            'social_links.*' => ['nullable', 'string', 'max:500'],
        ]);

        $profile = ArtistProfile::firstOrCreate(['user_id' => $artist->id]);

        $profile->update([
            'bio' => $data['bio'] ?? $profile->bio,
            'location_city' => $data['location_city'] ?? $profile->location_city,
            'location_country' => $data['location_country'] ?? $profile->location_country,
            'is_public' => (bool)($data['is_public'] ?? $profile->is_public),
            'allow_messages' => (bool)($data['allow_messages'] ?? $profile->allow_messages),
            'social_links' => $data['social_links'] ?? $profile->social_links,
        ]);

        toast_updated('Artist');

        return redirect()->route('admin.artists-profile.index');
    }

    public function destroy(User $artist)
    {
        abort_unless($artist->hasRole('Artist'), 404);

        try {
            $artist->delete();
            toast_deleted('Artist');
        } catch (\Throwable $e) {
            toast_error('Artist cannot be deleted right now.');
        }

        return back();
    }

    public function create()
    {
        // Optional: if you don't want admin to create artists here, remove this method
        abort(404);
    }

    public function store(Request $request)
    {
        abort(404);
    }

    public function show(User $artist)
    {
        abort_unless($artist->hasRole('Artist'), 404);

        $profile = ArtistProfile::firstOrCreate(
            ['user_id' => $artist->id],
            ['is_public' => true, 'allow_messages' => true]
        );

        $title = "Artist Profile";
        return view('admin.artists-profile.show', compact('artist', 'profile', 'title'));
    }
}

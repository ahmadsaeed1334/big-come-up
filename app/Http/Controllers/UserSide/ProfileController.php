<?php

namespace App\Http\Controllers\UserSide;

use App\Http\Controllers\Controller;
use App\Models\ArtistProfile;
use App\Models\UserNotificationPreference;
use App\Models\UserPrivacyPreference;
use App\Models\UserInterestPreference;
use App\Models\SweepstakesSetting;
use App\Models\ShopPreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        // Ensure profile + all prefs exist (no null issues in Blade)
        $artistProfile = ArtistProfile::firstOrCreate(
            ['user_id' => $user->id],
            ['is_public' => true, 'allow_messages' => true]
        );

        $notif = UserNotificationPreference::firstOrCreate(['user_id' => $user->id]);
        $privacy = UserPrivacyPreference::firstOrCreate(['user_id' => $user->id]);
        $interests = UserInterestPreference::firstOrCreate(['user_id' => $user->id], ['interests' => []]);
        $sweep = SweepstakesSetting::firstOrCreate(['user_id' => $user->id]);
        $shop = ShopPreference::firstOrCreate(['user_id' => $user->id]);

        // Later: load performances / votes / comments / watch history for tabs
        return view('user-side.profile.show', compact(
            'user',
            'artistProfile',
            'notif',
            'privacy',
            'interests',
            'sweep',
            'shop'
        ));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'country' => ['nullable', 'string', 'max:255'],
            'dob' => ['nullable', 'date'],

            'bio' => ['nullable', 'string'],
            'location_city' => ['nullable', 'string', 'max:255'],
            'location_country' => ['nullable', 'string', 'max:255'],

            // files optional (implement upload later)
            // 'avatar' => ['nullable','image','max:2048'],
            // 'banner' => ['nullable','image','max:4096'],

            'social_links' => ['nullable', 'array'],
            'social_links.*' => ['nullable', 'string', 'max:500'],
        ]);

        // update user core
        $user->update([
            'name' => $data['name'],
            'username' => $data['username'] ?? $user->username,
            'email' => $data['email'],
            'phone' => $data['phone'] ?? $user->phone,
            'country' => $data['country'] ?? $user->country,
            'dob' => $data['dob'] ?? $user->dob,
        ]);

        // update artist profile
        $profile = ArtistProfile::firstOrCreate(['user_id' => $user->id]);

        $profile->update([
            'bio' => $data['bio'] ?? $profile->bio,
            'location_city' => $data['location_city'] ?? $profile->location_city,
            'location_country' => $data['location_country'] ?? $profile->location_country,
            'social_links' => $data['social_links'] ?? $profile->social_links,
        ]);

        toast_updated('Profile');

        return back();
    }
}

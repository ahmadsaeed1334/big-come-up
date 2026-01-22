<?php

namespace App\Http\Controllers\UserSide;

use App\Http\Controllers\Controller;
use App\Models\UserNotificationPreference;
use App\Models\UserPrivacyPreference;
use App\Models\UserInterestPreference;
use App\Models\SweepstakesSetting;
use App\Models\ShopPreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function updateNotifications(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'email_competition_updates' => ['nullable', 'boolean'],
            'email_voting_reminders' => ['nullable', 'boolean'],
            'email_sweepstakes_results' => ['nullable', 'boolean'],
            'email_radio_show_alerts' => ['nullable', 'boolean'],
            'email_platform_announcements' => ['nullable', 'boolean'],
            'push_live_competitions' => ['nullable', 'boolean'],
            'push_new_performances' => ['nullable', 'boolean'],
            'push_winner_announcements' => ['nullable', 'boolean'],
            'push_community_activity' => ['nullable', 'boolean'],
        ]);

        $pref = UserNotificationPreference::firstOrCreate(['user_id' => $user->id]);

        // missing keys => false (important for toggles)
        $pref->update(array_merge([
            'email_competition_updates' => false,
            'email_voting_reminders' => false,
            'email_sweepstakes_results' => false,
            'email_radio_show_alerts' => false,
            'email_platform_announcements' => false,
            'push_live_competitions' => false,
            'push_new_performances' => false,
            'push_winner_announcements' => false,
            'push_community_activity' => false,
        ], $data));

        return response()->json(['ok' => true]);
    }

    public function updatePrivacy(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'public_profile_visibility' => ['nullable', 'boolean'],
            'show_activity_history' => ['nullable', 'boolean'],
            'show_votes_publicly' => ['nullable', 'boolean'],
            'allow_direct_messages' => ['nullable', 'boolean'],
        ]);

        $pref = UserPrivacyPreference::firstOrCreate(['user_id' => $user->id]);

        $pref->update(array_merge([
            'public_profile_visibility' => false,
            'show_activity_history' => false,
            'show_votes_publicly' => false,
            'allow_direct_messages' => false,
        ], $data));

        return response()->json(['ok' => true]);
    }

    public function updateInterests(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'interests' => ['nullable', 'array'],
            'interests.*' => ['string', 'max:50'],
        ]);

        $pref = UserInterestPreference::firstOrCreate(['user_id' => $user->id], ['interests' => []]);

        $pref->update([
            'interests' => $data['interests'] ?? [],
        ]);

        return response()->json(['ok' => true]);
    }

    public function updateSweepstakes(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'receive_notifications' => ['nullable', 'boolean'],
            'show_wins_publicly' => ['nullable', 'boolean'],
        ]);

        $pref = SweepstakesSetting::firstOrCreate(['user_id' => $user->id]);

        $pref->update(array_merge([
            'receive_notifications' => false,
            'show_wins_publicly' => false,
        ], $data));

        return response()->json(['ok' => true]);
    }

    public function updateShop(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'default_payment_method_id' => ['nullable', 'string', 'max:255'],
        ]);

        $pref = ShopPreference::firstOrCreate(['user_id' => $user->id]);

        $pref->update([
            'default_payment_method_id' => $data['default_payment_method_id'] ?? null,
        ]);

        return response()->json(['ok' => true]);
    }
}

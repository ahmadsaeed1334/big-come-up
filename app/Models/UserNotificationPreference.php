<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserNotificationPreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'email_competition_updates',
        'email_voting_reminders',
        'email_sweepstakes_results',
        'email_radio_show_alerts',
        'email_platform_announcements',
        'push_live_competitions',
        'push_new_performances',
        'push_winner_announcements',
        'push_community_activity',
    ];

    protected $casts = [
        'email_competition_updates' => 'boolean',
        'email_voting_reminders' => 'boolean',
        'email_sweepstakes_results' => 'boolean',
        'email_radio_show_alerts' => 'boolean',
        'email_platform_announcements' => 'boolean',
        'push_live_competitions' => 'boolean',
        'push_new_performances' => 'boolean',
        'push_winner_announcements' => 'boolean',
        'push_community_activity' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'user_type',
        'is_active',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'user_type' => 'integer',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function syncPrimaryRole(): void
    {
        $first = $this->getRoleNames()->first();
        $this->forceFill(['role' => $first])->saveQuietly();
    }
    public function artistProfile()
    {
        return $this->hasOne(ArtistProfile::class);
    }

    public function artistStat()
    {
        return $this->hasOne(ArtistStat::class);
    }

    public function performances()
    {
        return $this->hasMany(Performance::class);
    }

    public function artistsVote()
    {
        return $this->hasMany(ArtistsVote::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function watchHistories()
    {
        return $this->hasMany(WatchHistory::class);
    }

    public function notificationPreference()
    {
        return $this->hasOne(\App\Models\UserNotificationPreference::class);
    }

    public function privacyPreference()
    {
        return $this->hasOne(\App\Models\UserPrivacyPreference::class);
    }

    public function interestPreference()
    {
        return $this->hasOne(\App\Models\UserInterestPreference::class);
    }

    public function sweepstakesSetting()
    {
        return $this->hasOne(\App\Models\SweepstakesSetting::class);
    }

    public function shopPreference()
    {
        return $this->hasOne(\App\Models\ShopPreference::class);
    }

    public function loginSessions()
    {
        return $this->hasMany(\App\Models\LoginSession::class);
    }
}

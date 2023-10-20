<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function canManagePlayerProfile($playerId)
    {

        $authenticatedUserId = Auth::id();

        $collegesIds = DB::table('coach_sport')
            ->where('user_id', $authenticatedUserId)
            ->pluck('colleges_id')
            ->toArray();

        $sportsIds = DB::table('coach_sport')
            ->where('user_id', $authenticatedUserId)
            ->pluck('sports_id')
            ->toArray();

        $results = Player::select('players.*')
            ->whereHas('team', function ($query) use ($collegesIds, $sportsIds) {
                $query->whereIn('colleges_id', $collegesIds)
                    ->whereIn('sports_id', $sportsIds);
            })
            ->where('status', 'accepted')
            ->get();
        if ($results->contains('user_id', $playerId)) {

            return true; // Return true if the user is allowed to manage the player's profile.
        }

    }
    public function scopeWithRole($query, $roleName)
    {
        return $query->whereHas('roles', function ($query) use ($roleName) {
            $query->where('name', $roleName);
        });
    }

    public function sports()
    {
        return $this->belongsToMany(Sports::class, 'coach_sport');
    }
    public function colleges()
    {
        return $this->belongsToMany(Colleges::class);
    }
    public function userdetail()
    {
        return $this->hasOne(UserProfile::class, 'user_id');
    }
    public function profile()
    {
        return $this->hasOne(PlayerProfile::class);
    }
    public function sport_name()
    {
        return $this->belongsTo(Sports::class,'assigned_sport');
    }
    public function coachSports()
    {
        return $this->hasMany(coach_sport::class, 'user_id');
    }
    public function fields()
    {
        return $this->hasMany(FieldsValue::class, 'player_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function profile() {
        return $this->hasOne(PlayerProfile::class);
    }
    public function sports()
    {
        return $this->belongsToMany(Sports::class, 'coach_sport');
    }
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}

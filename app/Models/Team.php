<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function csname()
    {
        return $this->belongsTo(User::class,'createdBy', 'id');
    }
    public function sports()
    {
        return $this->belongsTo(Sports::class);
    }
    public function colleges()
    {
        return $this->belongsTo(Colleges::class);
    }
    public function player()
    {
        return $this->hasMany(Player::class);
    }
    public function coachSport()
    {
        return $this->belongsTo(coach_sport::class, 'user_id');
    }
}

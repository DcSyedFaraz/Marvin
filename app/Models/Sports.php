<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sports extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function colleges()
{
    return $this->belongsToMany(Colleges::class, 'college_has_sports');
}
public function coaches()
{
    return $this->belongsToMany(User::class, 'coach_sport', 'sports_id', 'user_id');
}
public function fields()
{
    return $this->hasMany(Field::class);
}
public function stats()
{
    return $this->hasMany(Stats::class);
}

}

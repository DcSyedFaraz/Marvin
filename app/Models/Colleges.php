<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colleges extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function sports()
    {
        return $this->belongsToMany(Sports::class, 'college_has_sports');
    }
    public function coaches()
    {
        return $this->belongsToMany(User::class);
    }


}

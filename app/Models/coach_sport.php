<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coach_sport extends Model
{
    protected $table = 'coach_sport';
    public $timestamps = false;
    protected $fillable = ['user_id', 'sports_id','colleges_id'];
    use HasFactory;

    public function colleges()
{
    return $this->belongsTo(Colleges::class, 'colleges_id');
}
    public function sports()
{
    return $this->belongsTo(Sports::class, 'sports_id');
}
}

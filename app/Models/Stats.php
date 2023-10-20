<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stats extends Model
{
    use HasFactory;
    protected $guarded=[];
    public $timestamps = false;

    public static function boot() {
        parent::boot();

        // Handle the deleting event to delete associated statsValues
        static::deleting(function ($stat) {
            $stat->statsValues()->delete();
        });
    }
    public function statsValues() {
        return $this->hasMany(StatsValue::class, 'stats_id', 'id');
    }
}

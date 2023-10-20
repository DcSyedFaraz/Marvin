<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldsValue extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;
    public function field_name()
    {
        return $this->belongsTo(Field::class,'field_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];
    public static function boot() {
        parent::boot();

        // Handle the deleting event to delete associated fieldValues
        static::deleting(function ($field) {
            $field->fieldValues()->delete();
        });
    }
    public function fieldValues() {
        return $this->hasMany(FieldsValue::class, 'field_id', 'id');
    }
    public function sport() {
        return $this->belongsTo(Sports::class,'sports_id','id');
    }
}

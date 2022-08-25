<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Position extends Model
{
    use HasFactory;

    const Active = 1;
    const Inactive = 2;
    const Occupied =3;

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => strtolower($value)
        );
    }
}

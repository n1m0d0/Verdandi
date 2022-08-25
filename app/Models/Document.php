<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory;

    const Active = 1;
    const Inactive = 2;

    public function roads()
    {
        return $this->hasMany(Road::class);
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => strtolower($value)
        );
    }

    protected function abbreviation(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtoupper($value)
        );
    }
}

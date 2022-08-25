<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Road extends Model
{
    use HasFactory;

    const Active = 1;
    const Inactive = 2;
    const Conclude = 3;

    public function roads()
    {
        return $this->hasMany(Road::class, 'parent_id');
    }

    public function childRoads()
    {
        return $this->hasMany(Road::class, 'parent_id')->with('roads');
    }

    public function roadmap()
    {
        return $this->belongsTo(Roadmap::class);
    }

    public function sentBy()
    {
        return $this->belongsTo(Assignment::class, 'sent_by');
    }

    public function sentTo()
    {
        return $this->belongsTo(Assignment::class, 'sent_to');
    }

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    protected function reference(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value)
        );
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    const Active = 1;
    const Inactive = 2;
    const Conclude = 3;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
    
    public function shipmentsBy()
    {
        return $this->hasMany(Road::class, 'sent_by');
    }

    public function shipmentsTo()
    {
        return $this->hasMany(Road::class, 'sent_to');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roadmap extends Model
{
    use HasFactory;

    const Active = 1;
    const Inactive = 2;    
    const Conclude = 3;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function roads()
    {
        return $this->hasMany(Road::class);
    }
}

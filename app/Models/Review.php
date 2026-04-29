<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'mentor_id',
        'startup_id',
        'rating',
        'review',
    ];

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function startup()
    {
        return $this->belongsTo(User::class, 'startup_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MentorProfile extends Model
{
    protected $fillable = [
        'user_id',
        'expertise',
        'experience',
        'availability',
        'pricing',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

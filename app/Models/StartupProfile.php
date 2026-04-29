<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StartupProfile extends Model
{
    protected $fillable = [
        'user_id',
        'startup_name',
        'industry',
        'stage',
        'problem',
        'help_needed',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MentorRequest extends Model
{
    protected $fillable = [
        'startup_id',
        'mentor_id',
        'message',
        'status',
    ];

    public function startup()
    {
        return $this->belongsTo(User::class, 'startup_id');
    }

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }
}

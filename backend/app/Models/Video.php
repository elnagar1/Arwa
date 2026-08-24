<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'course_id', 
        'title', 
        'description', 
        'youtube_url',
        'notes_url',
        'quiz_url',
        'available_from',
        'available_until',
        'is_locked'
    ];

    protected $casts = [
        'available_from' => 'datetime',
        'available_until' => 'datetime',
        'is_locked' => 'boolean',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}

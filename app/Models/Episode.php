<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Episode extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'video_url', 'course_id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}

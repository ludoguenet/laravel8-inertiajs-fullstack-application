<?php

namespace App\Models;

use App\Models\User;
use App\Models\Episode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Gate;

class Course extends Model
{
    use HasFactory, Authorizable;

    protected $fillable = ['title', 'description', 'user_id'];

    protected $appends = ['update'];

    protected static function booted()
    {
        static::creating(function ($course) {
            $course->user_id = auth()->id();
        });
    }

    public function getUpdateAttribute()
    {
        return $this->can('update-course', $this);
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

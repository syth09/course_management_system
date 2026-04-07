<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'description',
        'image',
        'status'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($course) {
            if (empty($course->slug)) {
                $course->slug = Str::slug($course->name);
            }
        });

        static::updating(function ($course) {
            if ($course->isDirty('name') && !$course->isDirty('slug')) {
                $course->slug = Str::slug($course->name);
            }
        });
    }

    // Relationships
    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('order');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments')
            ->withPivot('enrolled_at')
            ->withTimestamps();
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // Accessors
    public function getLessonCountAttribute()
    {
        return $this->lessons()->count();
    }

    public function getStudentCountAttribute()
    {
        return $this->enrollments()->count();
    }
}

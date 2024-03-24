<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_name',
        'course_description',
        'course_image',
        'enroll_count',
        'category_id',
        'user_id',
        'course_status'
    ];

    public function category(){
        return  $this->belongsTo(Category::class);
    }

    public function teacher(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function topics(){
      return  $this->hasMany(Topic::class);
    }

    public function enrollments(){
        return $this->hasMany(Enrollment::class);
    }
}

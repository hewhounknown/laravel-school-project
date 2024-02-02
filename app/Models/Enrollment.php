<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'status'
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function courses(){
        return $this->belongsTo(Course::class);
    }
}

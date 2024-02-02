<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic_name',
        'topic_description',
        'course_id'
    ];

    public function contents(){
        return $this->hasMany(Content::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }
}

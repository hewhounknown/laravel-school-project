<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'category_description',
        'program_id'
    ];

    public function program(){
        return $this->belongsTo(Program::class);
    }

    public function courses(){
     return $this->hasMany(Course::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_name',
        'author_name',
        'cover',
        'book_path',
        'posted_by'
    ];
}

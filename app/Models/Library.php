<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Library extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_name',
        'author_name',
        'cover',
        'book_path',
        'posted_by',
        'public_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }
}

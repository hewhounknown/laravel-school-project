<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content_type',
        'content_body',
        'content_path',
        'topic_id'
    ];

    public function topic(){
        return $this->belongsTo(Topic::class);
    }
}

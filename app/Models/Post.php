<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'short_text',
        'description',
        'image',
        'tag',
        'author_id',
        'author_name'
    ];
}

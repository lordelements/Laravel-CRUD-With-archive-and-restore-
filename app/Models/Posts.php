<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'posts';
    
    protected $fillable =[
        'posts_title',
        'posts_subtitle',
        'posts_file',
        'posts_descriptions',
        'datetime_posted',
    ];

}

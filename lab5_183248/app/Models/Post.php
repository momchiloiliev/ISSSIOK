<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['title', 'author', 'body', 'slug', 'published_on', 'last_modified'];

    public function author(){
        return $this->belongsTo(User::class, 'author');
    } 

    public function comments()
    {
        return $this->hasMany(Comment::class, 'on_post');
    }




}
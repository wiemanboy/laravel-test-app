<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

/*
 * Model is basically a class that represents a table in the database,
 * similar to Spring/.NET but without the business logic(from what i understand).
 */

class Post extends Model
{
    use HasApiTokens, HasFactory;

    protected $attributes = [
        'caption' => '',
        'is_private' => true,
    ];

    protected $fillable = [
        'post_id',
        'caption',
        'is_private',
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function addComment($comment)
    {
        $this->comments()->create($comment);
    }
}

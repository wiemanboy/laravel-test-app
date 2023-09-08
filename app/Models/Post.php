<?php

namespace App\Models;

use App\Enums\PostStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

/*
 * Model is basically a class that represents a table in the database,
 * similar to a domain class in Spring/.NET but without the business logic(from what i understand).
 */

class Post extends Model
{
    use HasApiTokens, HasFactory;

    protected $attributes = [
        'caption' => '',
        'message' => '',
        'is_private' => true,
        'status' => 'active',
    ];

    protected $fillable = [
        'id',
        'user_id',
        'message',
        'caption',
        'is_private',
        'status',
    ];

    protected $casts = [
        'is_private' => 'boolean',
        'status' => PostStatus::class,
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function addComment(Comment &$comment): void
    {
        $this->comments()->save($comment);
    }
}

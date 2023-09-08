<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Comment extends Model
{
    use HasFactory ;

    protected $attributes = [
        'message' => '',
    ];

    protected $fillable = [
        'user_id',
        'message',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isAppropriate(): bool
    {
            return !Str::contains($this->message, 'bad');
    }
}

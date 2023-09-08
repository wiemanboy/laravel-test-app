<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        if (strlen($this->message) > 100) {
            return false;
        }
        if (stripos($this->message, 'bad')) {
            return false;
        }

        return true;
    }
}

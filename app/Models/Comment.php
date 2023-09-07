<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory ;

    protected $attributes = [
        'message' => '',
    ];

    protected $fillable = [
        'message',
    ];

    public function isAppropriate(): bool
    {
        if (!strlen($this->message) > 100) {
            return false;
        }
        if (stripos($this->message, 'bad')) {
            return false;
        }

        return true;
    }
}

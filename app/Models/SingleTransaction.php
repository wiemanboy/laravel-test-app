<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SingleTransaction extends Model implements Transaction
{
    use HasFactory;

    protected $fillable = [
        'id',
        'amount',
    ];

    public function getAmount(): int
    {
        return $this->amount;
    }
}

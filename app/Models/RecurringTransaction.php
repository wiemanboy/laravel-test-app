<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecurringTransaction extends Model implements Transaction
{
    use HasFactory;

    protected $fillable = [
        'id',
        'amount',
        'frequency',
    ];

    public function getAmount(): int
    {
        return $this->amount;
    }
}

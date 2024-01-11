<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    private function single_transactions(): HasMany
    {
        return $this->hasMany(SingleTransaction::class);
    }

    private function recurring_transactions(): HasMany
    {
        return $this->hasMany(RecurringTransaction::class);
    }

    public function getTransactions(): array
    {
        $allTransactions = array_merge(
            $this->single_transactions()->get()->all(),
            $this->recurring_transactions()->get()->all()
        );
        return (new Collection($allTransactions))->sortBy('id')->values()->all();
    }

    public function addTransaction(Transaction $transaction): void
    {
        if ($transaction instanceof SingleTransaction) {
            $this->single_transactions()->save($transaction);
        }
        if ($transaction instanceof RecurringTransaction) {
            $this->recurring_transactions()->save($transaction);
        }
        $this->push();
        $this->incrementId($transaction);
    }

    private function incrementId(Transaction $transaction)
    {
        $this->refresh();
        $transaction->id = max(array_column($this->getTransactions(), 'id')) + 1;
        $transaction->save();
        $this->refresh();
    }
}

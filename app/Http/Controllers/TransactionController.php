<?php

namespace App\Http\Controllers;

use App\Models\RecurringTransaction;
use App\Models\SingleTransaction;

class TransactionController extends Controller
{
    public function getTransactions()
    {

        $user = auth()->user();
        $user->addTransaction(new SingleTransaction([
            'amount' => 100,
        ]));
        $user->addTransaction(new RecurringTransaction([
            'amount' => 50,
            'frequency' => 'monthly',
        ]));

        return json_encode($user->getTransactions());
    }
}

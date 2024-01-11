<?php

namespace App\Models;

interface Transaction
{
    public function getAmount(): int;
}

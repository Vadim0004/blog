<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface SorterInterface
{
    public function order(Builder $query): Builder;
}

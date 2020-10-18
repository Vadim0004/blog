<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface FilterInterface
{
    public function filter(Builder $query): Builder;
}

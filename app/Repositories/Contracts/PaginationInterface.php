<?php

namespace App\Repositories\Contracts;

interface PaginationInterface
{
    public function getPagination(): int;
}

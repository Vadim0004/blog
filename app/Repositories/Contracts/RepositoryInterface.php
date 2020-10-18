<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    public function all(FilterInterface $filter, SorterInterface $sorting, PaginationInterface $pagination);

    public function one(FilterInterface $filter);

    public function getFilter();

    public function getSorter();
}

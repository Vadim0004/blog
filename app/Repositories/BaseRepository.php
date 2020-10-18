<?php

namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Exceptions\NoEntityDefined;
use App\Repositories\Contracts\FilterInterface;
use App\Repositories\Contracts\SorterInterface;
use App\Repositories\Contracts\PaginationInterface;

abstract class BaseRepository implements RepositoryInterface
{
    private $entity;

    public function __construct()
    {
        $this->entity = $this->resolveEntity();
    }

    abstract public function getFilter();

    abstract public function getSorter();

    /**
     * All
     *
     * @param FilterInterface $filter
     * @param SorterInterface $sorting
     * @param PaginationInterface|null $pagination
     * @return mixed
     */
    public function all(FilterInterface $filter, SorterInterface $sorting, PaginationInterface $pagination = null)
    {
        $query = $this->entity->query();
        $filter->filter($query);
        $sorting->order($query);

        if ($pagination != null) {
            return $query->paginate($pagination->getPagination());
        }

        return $query->get();
    }

    public function one(FilterInterface $filter)
    {
        $filter->filter($this->entity)->get();

        return $this->entity->one();
    }

    private function resolveEntity()
    {
        if (!method_exists($this, 'entity')) {
            throw new NoEntityDefined();
        }

        return app($this->entity());
    }
}

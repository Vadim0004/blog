<?php

namespace App\Repositories\Eloquent\Filters;

use App\Repositories\Filters\FilterInterface;

class EagerLoad implements FilterInterface
{
    protected $relations;

    public function __construct(array $relations)
    {
        $this->relations = $relations;
    }

    public function apply($entity)
    {
        return $entity->with($this->relations);
    }
}

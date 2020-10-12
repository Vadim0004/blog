<?php

namespace App\Repositories\Eloquent\User\Filters;

use App\Repositories\Filters\FilterInterface;

class ByStatusUser implements FilterInterface
{
    /**
     * @var string
     */
    protected $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    public function apply($entity)
    {
        return $entity->where('status', $this->status);
    }
}

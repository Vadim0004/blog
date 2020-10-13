<?php

namespace App\Repositories\Eloquent\User\Filters;

use App\Repositories\Filters\FilterInterface;

class ByOrderIdUser implements FilterInterface
{
    /**
     * @var string
     */
    private $orderType;

    public function __construct($orderType)
    {
        $this->orderType = $orderType;
    }

    public function apply($entity)
    {
        return $entity->orderBy('id', $this->orderType);
    }
}

<?php

namespace App\Repositories\Eloquent\User\Filters;

use App\Repositories\Filters\FilterInterface;

class ByUser implements FilterInterface
{
    /**
     * @var int
     */
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function apply($entity)
    {
        return $entity->where('id', $this->userId);
    }
}

<?php

namespace App\Repositories\Eloquent\User;

use App\Repositories\RepositoryAbstract;
use App\Entity\User\User;

class EloquentUserRepository extends RepositoryAbstract
{
    public function entity()
    {
        return User::class;
    }

    public function withFilters(array $filters)
    {
        // TODO: Implement withFilters() method.
    }
}

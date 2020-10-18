<?php

namespace App\Repositories;

use App\Entity\User\User;
use App\Repositories\Filters\UserFilter;
use App\Repositories\Paginations\UserPagination;
use App\Repositories\Sorters\UserSorter;

class UserRepository extends BaseRepository
{
    public function entity()
    {
        return User::class;
    }

    public function getFilter()
    {
        return new UserFilter();
    }

    public function getSorter()
    {
        return new UserSorter();
    }

    public function getPagination()
    {
        return new UserPagination();
    }
}

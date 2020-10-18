<?php

namespace App\Repositories\Paginations;

use App\Repositories\Contracts\PaginationInterface;

class UserPagination implements PaginationInterface
{
    /**
     * @var integer
     */
    private const DEFAULT_PAGINATION = 20;
    /**
     * @var integer
     */
    private $pagination;

    /**
     * Set Pagination
     *
     * @param int $pagination
     * @return $this
     */
    public function setPagination(int $pagination)
    {
        $this->pagination = $pagination;

        return $this;
    }

    /**
     * Get Pagination
     *
     * @return int
     */
    public function getPagination(): int
    {
        if ($this->pagination) {
            return $this->pagination;
        }

        return self::DEFAULT_PAGINATION;
    }
}

<?php

namespace App\Repositories\Sorters;

use App\Repositories\Contracts\SorterInterface;
use Illuminate\Database\Eloquent\Builder;

class UserSorter implements SorterInterface
{
    /**
     * @var integer
     */
    private $field;
    /**
     * @var string
     */
    private $direction;

    /**
     * Set Field
     *
     * @param string $field
     * @return $this
     */
    public function setField(string $field)
    {
        $this->field = $field;

        return $this;
    }

    /**
     * Set Direction
     *
     * @param string $direction
     * @return $this
     */
    public function setDirection(string $direction)
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * Order
     *
     * @param Builder $query
     * @return Builder
     */
    public function order(Builder $query): Builder
    {
        if ($this->field && $this->direction) {
            $query->orderBy($this->field, $this->direction);
        }

        return $query;
    }
}

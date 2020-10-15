<?php

namespace App\Repositories\Eloquent\Filters;

use Illuminate\Database\Eloquent\Builder;

class Has
{
    private $relation;

    /**
     * Has constructor.
     *
     * @param $relation
     */
    public function __construct($relation)
    {
        $this->relation = $relation;
    }

    /**
     * Apply
     *
     * @param $model
     * @return Builder
     */
    public function apply($model): Builder
    {
        return $model->has($this->relation);
    }
}

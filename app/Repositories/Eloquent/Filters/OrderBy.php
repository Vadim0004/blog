<?php

namespace App\Repositories\Eloquent\Filters;

use Illuminate\Database\Eloquent\Builder;

class OrderBy
{
    /**
     * @var string
     */
    private $column;
    /**
     * @var string
     */
    private $dir;

    /**
     * OrderBy constructor.
     * @param string $column
     * @param string $dir
     */
    public function __construct(string $column, string $dir = 'asc')
    {
        $this->column = $column;
        $this->dir = $dir;
    }

    /**
     * Apply
     *
     * @param $model
     * @return Builder
     */
    public function apply($model): Builder
    {
        return $model->orderBy($this->column, $this->dir);
    }
}

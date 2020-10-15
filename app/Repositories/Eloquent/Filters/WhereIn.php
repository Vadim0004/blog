<?php

namespace App\Repositories\Eloquent\Filters;

use Illuminate\Database\Eloquent\Builder;

class WhereIn
{
    /**
     * @var string
     */
    private $column;
    /**
     * @var array
     */
    private $values;

    /**
     * WhereIn constructor.
     * @param string $column
     * @param array|null $values
     */
    public function __construct(string $column, array $values = null)
    {
        $this->column = $column;
        $this->values = $values;
    }

    /**
     * Apply
     *
     * @param $model
     * @return Builder
     */
    public function apply($model): Builder
    {
        return null === $this->values ? $model->newQuery() : $model->whereIn($this->column, $this->values);
    }
}

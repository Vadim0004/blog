<?php

namespace App\Repositories\Eloquent\Filters;

use Illuminate\Database\Eloquent\Builder;

class Where
{
    /**
     * @var string
     */
    private $column;
    /**
     * @var string
     */
    private $value;

    /**
     * Where constructor.
     * @param string $column
     * @param string $value
     */
    public function __construct(string $column, string $value)
    {
        $this->column = $column;
        $this->value = $value;
    }

    /**
     * Apply
     *
     * @param $model
     * @return Builder
     */
    public function apply($model): Builder
    {
        return $model->where($this->column, $this->value);
    }
}

<?php

namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Filters\FiltersInterface;
use App\Repositories\Exceptions\NoEntityDefined;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Arr;

abstract class RepositoryAbstract implements RepositoryInterface, FiltersInterface
{
    private $entity;

    public function __construct()
    {
        $this->entity = $this->resolveEntity();
    }

    public function all()
    {
        return $this->entity->get();
    }

    public function find(int $id)
    {
        $model = $this->entity->find($id);

        if (!$model) {
            throw (new ModelNotFoundException)->setModel(
                get_class($this->entity->getModel()), $id
            );
        }

        return $model;
    }

    public function findWhere($column, $value)
    {
        return $this->entity->where($column, $value)->get();
    }

    public function findWhereFirst($column, $value)
    {
        $model = $this->entity->where($column, $value)->first();

        if (!$model) {
            throw (new ModelNotFoundException)->setModel(
                get_class($this->entity->getModel())
            );
        }

        return $model;
    }

    public function paginate(int $perPage = 15)
    {
        return $this->entity->paginate($perPage);
    }

    public function create(array $properties)
    {
        return $this->entity->create($properties);
    }

    public function update(int $id, array $properties)
    {
        return $this->find($id)->update($properties);
    }

    public function delete(int $id)
    {
        return $this->find($id)->delete();
    }

    public function withFilter(array $filters)
    {
        $filters = Arr::flatten($filters);

        foreach ($filters as $filter) {
            $this->entity = $filter->apply($this->entity);
        }

        return $this;
    }

    protected function resolveEntity()
    {
        if (!method_exists($this, 'entity')) {
            throw new NoEntityDefined();
        }

        return app()->make($this->entity());
    }
}

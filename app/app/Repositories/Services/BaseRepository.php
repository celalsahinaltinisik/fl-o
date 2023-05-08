<?php

namespace App\Repositories\Services;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = []): Collection
    {
        return $this->newQuery()->with($relations)->get($columns);
    }

    /**
     * Summary of create
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->newQuery()->create($attributes);
    }

    /**
     * Summary of update
     * @param array $attributes
     * @return int
     */
    public function updated(array $attributes, int $id): int
    {
        return $this->newQuery()->where('id', $id)->update($attributes);
    }

    /**
     * Summary of delete
     * @param int $id
     * @return mixed
     */
    public function deleted(int $id): mixed
    {
        return $this->newQuery()->where('id', $id)->delete();
    }
    /**
     * Summary of find
     * @param int $id
     * @return Model|null
     */
    public function find(int $id): ?Model
    {
        return $this->newQuery()->find($id);
    }

    /**
     * Summary of newQuery
     * @return Builder
     */
    public function newQuery(): Builder
    {
        return $this->model->newQuery();
    }
}

<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseRepository
{
    protected Model $model;

    abstract public function getModel(): string;

    public function __construct()
    {
        $this->model = app($this->getModel());
    }

    /**
     * Get all records
     */
    public function all(array $columns = ['*']): Collection
    {
        return $this->model->get($columns);
    }

    /**
     * Get paginated records
     */
    public function paginate(int $perPage = 15, array $columns = ['*'])
    {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * Find by ID
     */
    public function find(int $id, array $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    /**
     * Find by ID or fail
     */
    public function findOrFail(int $id, array $columns = ['*'])
    {
        return $this->model->findOrFail($id, $columns);
    }

    /**
     * Find by column
     */
    public function findByColumn(string $column, $value, array $columns = ['*'])
    {
        return $this->model->where($column, $value)->first($columns);
    }

    /**
     * Create record
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update record
     */
    public function update(int $id, array $data): bool
    {
        $record = $this->findOrFail($id);
        return $record->update($data);
    }

    /**
     * Delete record
     */
    public function delete(int $id): bool
    {
        $record = $this->findOrFail($id);
        return $record->delete();
    }

    /**
     * Force delete record
     */
    public function forceDelete(int $id): bool
    {
        $record = $this->findOrFail($id);
        return $record->forceDelete();
    }

    /**
     * Restore soft-deleted record
     */
    public function restore(int $id): bool
    {
        $record = $this->model->onlyTrashed()->findOrFail($id);
        return $record->restore();
    }

    /**
     * Get where conditions
     */
    public function where(array $conditions, array $columns = ['*']): Collection
    {
        $query = $this->model;

        foreach ($conditions as $column => $value) {
            $query = $query->where($column, $value);
        }

        return $query->get($columns);
    }

    /**
     * Get with relationships
     */
    public function with(array $relations, array $columns = ['*']): Collection
    {
        return $this->model->with($relations)->get($columns);
    }

    /**
     * Count records
     */
    public function count(): int
    {
        return $this->model->count();
    }

    /**
     * Check if record exists
     */
    public function exists(string $column, $value): bool
    {
        return $this->model->where($column, $value)->exists();
    }

    /**
     * Get first record
     */
    public function first(array $columns = ['*'])
    {
        return $this->model->first($columns);
    }

    /**
     * Get last record
     */
    public function last(array $columns = ['*'])
    {
        return $this->model->latest()->first($columns);
    }
}

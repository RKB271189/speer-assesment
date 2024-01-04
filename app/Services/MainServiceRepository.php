<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

final class MainServiceRepository implements MainServiceInterface
{

    public function __construct(private Model $model)
    {
    }

    public function getAll()
    {
        $collection = $this->model->get();
        return $collection->toArray();
    }
    public function findById($id): array
    {
        $collection = $this->model->find($id);
        return ($collection) ? $collection->toArray() : null;
    }
    public function save(array $params): array
    {
        $collection = $this->model->create($params);
        return $collection->toArray();
    }

    public function update($id, array $params): array
    {
        $collection = $this->model->findOrFail($id);
        $record = tap($collection)->update($params);
        return $record->toArray();
    }

    public function delete($id)
    {
        $collection = $this->model->findorfail($id);
        return $collection->delete();
    }
}

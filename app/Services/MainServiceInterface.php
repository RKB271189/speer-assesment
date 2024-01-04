<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;

interface MainServiceInterface
{

    public function getAll();

    public function findById($id): ?Collection;

    public function save(array $params): array;

    public function update($id, array $params): array;

    public function delete($id);
}

<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

interface MainServiceInterface
{

    public function getAll();

    public function findById($id): ?Model;

    public function save(array $params): array;

    public function update($id, array $params): array;

    public function delete($id);
}

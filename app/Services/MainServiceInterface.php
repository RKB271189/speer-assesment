<?php

namespace App\Services;

interface MainServiceInterface
{

    public function getAll();

    public function save(array $params): array;

    public function update($id, array $params): array;

    public function delete($id);
}

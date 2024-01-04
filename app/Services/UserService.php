<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

final class UserService extends MainServiceRepository
{
    private $table;
    public function __construct(User $user)
    {
        $this->table = $user;
        parent::__construct($user);
    }
    public function createUser(array $params): User
    {
        $collection = $this->table->create($params);
        return $collection;
    }
}

<?php

namespace App\Services;

use App\Models\User;

final class UserService extends MainServiceRepository
{
    private $table;
    public function __construct(User $user)
    {
        $this->table = $user;
        parent::__construct($user);
    }
}

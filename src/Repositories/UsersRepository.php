<?php

namespace HopHey\Rbac\Repositories;

use HopHey\Rbac\Contracts\Repository;

class UsersRepository implements Repository
{
    protected array $users = [];

    public function insert(string $key): void
    {
        if (!isset($this->users[$key])) {
            $this->users[$key] = ['roles' => []];
        }
    }

    public function delete(string $key): void
    {
        unset($this->users[$key]);
    }

    public function exists(string $key): bool
    {
        return isset($this->users[$key]);
    }

    public function getUserRoles(string $key): array
    {
        return $this->users[$key]['roles'];
    }
}
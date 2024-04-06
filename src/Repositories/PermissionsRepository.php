<?php

namespace HopHey\Rbac\Repositories;

use HopHey\Rbac\Contracts\Repository;

class PermissionsRepository implements Repository
{
    protected array $permissions = [];


    public function insert(string $key): void
    {
        $this->permissions[$key] = [];
    }

    public function delete(string $key): void
    {
        unset($this->permissions[$key]);
    }

    public function exists(string $key): bool
    {
        return isset($this->permissions[$key]);
    }
}
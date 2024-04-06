<?php

namespace HopHey\Rbac\Repositories;

use HopHey\Rbac\Contracts\Repository;

class RolesRepository implements Repository
{
    protected array $roles = [];


    public function insert(string $key): void
    {
        $this->roles[$key] = [];
    }

    public function exists(string $key): bool
    {
        return isset($this->roles[$key]);
    }

    public function delete(string $key):void
    {
        if($this->exists($key)){
            unset($this->roles[$key]);
        }
    }
}
<?php

namespace HopHey\Rbac\Repositories;

use HopHey\Rbac\Contracts\RolePermissionRepository;

class RolesPermissionsRepository implements RolePermissionRepository
{

    protected array $roles = [];

    public function insert(string $role, string $permission): void
    {
        $this->roles[$role]['permissions'][] = $permission;
    }

    public function delete(string $role, string $permission): void
    {
        if($this->exists($role, $permission)){
            $idx = array_search($role, $this->roles[$role]['permissions']);
            unset($this->roles[$role]['permissions'][$idx]);
        }
    }

    public function exists(string $role, string $permission): bool
    {
        if(!isset($this->roles[$role])){
            return false;
        }
        return in_array($permission, $this->roles[$role]['permissions']);
    }

    public function removeAllPermissionsByRole(string $role): void
    {
        $this->roles[$role]['permissions'] = [];
    }
}
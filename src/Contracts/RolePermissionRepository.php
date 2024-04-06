<?php

namespace HopHey\Rbac\Contracts;

interface RolePermissionRepository
{
    public function insert(string $role, string $permission): void;

    public function delete(string $role, string $permission): void;

    public function exists(string $role, string $permission): bool;

    public function removeAllPermissionsByRole(string $role): void;
}
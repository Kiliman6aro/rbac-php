<?php

namespace HopHey\Rbac\Contracts;

interface UserRoleRepository
{
    public function insert(string $user, string $role): void;
    public function delete(string $user, string $role): void;
    public function exists(string $user, string $role): bool;
    public function removeAllRolesByUser(string $user): void;
}
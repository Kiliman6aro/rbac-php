<?php

namespace HopHey\Rbac;

class RBAC
{

    protected array $roles = [];

    protected array $permissions = [];

    protected array $users = [];


    public function createRole(string $name): void
    {
        $this->roles[$name] = [];
    }

    public function roleExists(string $name): bool
    {
        return isset($this->roles[$name]);
    }

    public function deleteRole(string $roleName):void
    {
        if($this->roleExists($roleName)){
            unset($this->roles[$roleName]);
        }
    }

    public function createPermission(string $name): void
    {
        $this->permissions[$name] = [];
    }

    public function deletePermission(string $name): void
    {
        unset($this->permissions[$name]);
    }

    public function permissionExists(string $name): bool
    {
        return isset($this->permissions[$name]);
    }

    public function assignPermissionToRole(string $permissionName, string $roleName): void
    {
        if (!$this->isPermissionAssignedToRole($permissionName, $roleName)) {
            $this->roles[$roleName][] = $permissionName;
        }
    }

    public function revokePermissionFromRole(string $permissionName, string $roleName): void
    {
        if ($this->isPermissionAssignedToRole($permissionName, $roleName)) {
            $index = array_search($permissionName, $this->roles[$roleName]);
            if ($index !== false) {
                unset($this->roles[$roleName][$index]);
            }
        }
    }
    public function isPermissionAssignedToRole(string $permissionName, string $roleName): bool
    {
        if (isset($this->permissions[$permissionName]) && isset($this->roles[$roleName])) {
            return in_array($permissionName, $this->roles[$roleName]);
        }
        return false;
    }

    public function addUserToRole(string $userName, string $roleName): void
    {
        if (!isset($this->users[$userName])) {
            $this->users[$userName] = ['roles' => []];
        }

        if (isset($this->roles[$roleName])) {
            $this->roles[$roleName]['users'][] = $userName;
            $this->users[$userName]['roles'][] = $roleName;
        }
    }

    public function userHasPermission(string $userName, string $permissionName): bool
    {
        if (!isset($this->users[$userName])) {
            return false;
        }

        $roles = $this->users[$userName]['roles'] ?? [];

        foreach ($roles as $role) {
            if ($this->isPermissionAssignedToRole($permissionName, $role)) {
                return true;
            }
        }

        return false;
    }

}
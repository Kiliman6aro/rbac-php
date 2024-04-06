<?php

namespace HopHey\Rbac\Repositories;

use HopHey\Rbac\Contracts\UserRoleRepository;

class UsersRolesRepository implements UserRoleRepository
{
    protected array $users = [];

    public function insert(string $user, string $role): void
    {
        $this->users[$user]['roles'][] = $role;
    }

    public function delete(string $user, string $role): void
    {
        if($this->exists($user, $role)){
            $idx = array_search($role, $this->users[$user]['roles']);
            unset($this->users[$user]['roles'][$idx]);
        }
    }

    public function exists(string $user, string $role): bool
    {
        if(!isset($this->users[$user])){
            return false;
        }
        return in_array($role, $this->users[$user]['roles'], true);
    }

    public function removeAllRolesByUser(string $user): void
    {
        $this->users[$user]['roles'] = [];
    }

}
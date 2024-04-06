<?php

namespace HopHey\Rbac;

use HopHey\Rbac\Repositories\UsersRolesRepository;

class AuthorizationManager
{
    protected UsersRolesRepository $usersRolesRepository;

    /**
     * @param UsersRolesRepository $usersRolesRepository
     */
    public function __construct(UsersRolesRepository $usersRolesRepository)
    {
        $this->usersRolesRepository = $usersRolesRepository;
    }

    public function assignRoleToUser(string $roleName, string $userName): void
    {
        $this->usersRolesRepository->insert($userName, $roleName);
    }

    public function userHasRole(string $userName, string $roleName): bool
    {
        return $this->usersRolesRepository->exists($userName, $roleName);
    }

}
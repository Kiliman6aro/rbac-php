<?php

namespace HopHey\Rbac\Managers;

use HopHey\Rbac\Entities\Role;
use HopHey\Rbac\Repositories\RolesRepository;

class RoleManager
{
    protected RolesRepository $repository;

    /**
     * @param RolesRepository $repository
     */
    public function __construct(RolesRepository $repository)
    {
        $this->repository = $repository;
    }


    public function createRole(string $name): void
    {
        $this->repository->insert($name);
    }

    public function getRole(string $name): ?Role
    {
        return $this->repository->findRoleByName($name);
    }

    public function revokeRole(string $string): void
    {
        $this->repository->delete($string);
    }
}
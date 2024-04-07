<?php

namespace HopHey\Rbac\Managers;

use HopHey\Rbac\Entities\Permission;
use HopHey\Rbac\Repositories\PermissionsRepository;

class PermissionManager
{

    protected PermissionsRepository $repository;

    /**
     * @param PermissionsRepository $repository
     */
    public function __construct(PermissionsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createPermission(string $name):void
    {
        $this->repository->insert($name);
    }

    public function getPermission(string $name): ?Permission
    {
        return $this->repository->findPermissionByName($name);
    }

    public function removePermission(string $name): void
    {
        $this->repository->delete($name);
    }
}
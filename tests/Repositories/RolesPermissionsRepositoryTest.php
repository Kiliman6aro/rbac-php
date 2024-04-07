<?php

namespace Repositories;

use HopHey\Rbac\Repositories\RolesPermissionsRepository;
use PHPUnit\Framework\TestCase;

class RolesPermissionsRepositoryTest extends TestCase
{
    protected RolesPermissionsRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new RolesPermissionsRepository();
    }

    public function testInsert(): void
    {
        $role = 'admin';
        $permission = 'editPost';

        $this->repository->insert($role, $permission);

        $this->assertTrue($this->repository->exists($role, $permission));
    }

    public function testDelete(): void
    {
        $role = 'admin';
        $permission = 'editPost';

        $this->repository->insert($role, $permission);
        $this->repository->delete($role, $permission);

        $this->assertFalse($this->repository->exists($role, $permission));
    }

    public function testExists(): void
    {
        $role = 'admin';
        $permission = 'editPost';

        $this->assertFalse($this->repository->exists($role, $permission));

        $this->repository->insert($role, $permission);

        $this->assertTrue($this->repository->exists($role, $permission));
    }

    public function testRemoveAllPermissionsByRole(): void
    {
        $role = 'admin';
        $permission = 'editPost';

        $this->repository->insert($role, $permission);
        $this->repository->removeAllPermissionsByRole($role);

        $this->assertFalse($this->repository->exists($role, $permission));
    }
}
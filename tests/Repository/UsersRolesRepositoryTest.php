<?php

namespace Repository;

use HopHey\Rbac\Repositories\UsersRolesRepository;
use PHPUnit\Framework\TestCase;

class UsersRolesRepositoryTest extends TestCase
{
    protected UsersRolesRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new UsersRolesRepository();
    }

    public function testInsert(): void
    {
        $user = 'john';
        $role = 'admin';

        $this->repository->insert($user, $role);

        $this->assertTrue($this->repository->exists($user, $role));
    }

    public function testDelete(): void
    {
        $user = 'john';
        $role = 'admin';

        $this->repository->insert($user, $role);
        $this->repository->delete($user, $role);

        $this->assertFalse($this->repository->exists($user, $role));
    }

    public function testExists(): void
    {
        $user = 'john';
        $role = 'admin';

        $this->assertFalse($this->repository->exists($user, $role));

        $this->repository->insert($user, $role);

        $this->assertTrue($this->repository->exists($user, $role));
    }

    public function testRemoveAllRolesByUser(): void
    {
        $user = 'john';
        $role = 'admin';

        $this->repository->insert($user, $role);
        $this->repository->removeAllRolesByUser($user);

        $this->assertFalse($this->repository->exists($user, $role));
    }
}
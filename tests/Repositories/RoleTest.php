<?php

namespace Repositories;

use HopHey\Rbac\Repositories\RolesRepository;
use PHPUnit\Framework\TestCase;

class RoleTest extends TestCase
{
    protected RolesRepository $rolesRepository;

    protected function setUp(): void
    {
        $this->rolesRepository = new RolesRepository();
    }

    public function testInsert()
    {
        $this->assertFalse($this->rolesRepository->exists('admin'));
        $this->rolesRepository->insert('admin');
        $this->assertTrue($this->rolesRepository->exists('admin'));
    }

    public function testDelete()
    {
        $this->rolesRepository->insert('admin');
        $this->assertTrue($this->rolesRepository->exists('admin'));
        $this->rolesRepository->delete('admin');
        $this->assertFalse($this->rolesRepository->exists('admin'));
    }
}
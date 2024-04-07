<?php

namespace Managers;

use HopHey\Rbac\Entities\Role;
use HopHey\Rbac\Managers\RoleManager;
use HopHey\Rbac\Repositories\RolesRepository;
use PHPUnit\Framework\TestCase;

class RoleManagerTest extends TestCase
{
    protected RoleManager$manager;
    protected function setUp(): void
    {
        parent::setUp();
        $this->manager = new RoleManager(new RolesRepository());
    }


    public function testCreateRole(): void
    {


        $this->manager->createRole('admin');

        $role = $this->manager->getRole('admin');
        $this->assertInstanceOf(Role::class, $role);
        $this->assertEquals('admin', $role->getName());
    }

    public function testRevokeRole(): void
    {
        $this->manager->createRole('admin');
        $this->manager->revokeRole('admin');
        $role = $this->manager->getRole('admin');
        $this->assertNull($role);
    }
}
<?php

namespace Managers;

use HopHey\Rbac\Entities\Permission;
use HopHey\Rbac\Managers\PermissionManager;
use HopHey\Rbac\Repositories\PermissionsRepository;
use PHPUnit\Framework\TestCase;

class PermissionManagerTest extends TestCase
{
    protected PermissionManager $manager;
    protected function setUp(): void
    {
        parent::setUp();
        $this->manager = new PermissionManager(new PermissionsRepository());
    }

    public function testCreatePermission()
    {
        $permissionName = 'editPost';
        $this->manager->createPermission($permissionName);
        $permission = $this->manager->getPermission($permissionName);
        $this->assertInstanceOf(Permission::class, $permission);
        $this->assertEquals($permissionName, $permission->getName());
    }

    public function testRemovePermission()
    {
        $permissionName = 'editPost';
        $this->manager->createPermission($permissionName);
        $this->manager->removePermission($permissionName);
        $this->assertNull($this->manager->getPermission($permissionName));
    }
}
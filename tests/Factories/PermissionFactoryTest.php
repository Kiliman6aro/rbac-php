<?php

namespace HopHey\Rbac\Tests\Factories;
use HopHey\Rbac\Contracts\Identity;
use HopHey\Rbac\Entities\Permission;
use HopHey\Rbac\Entities\StaticIntegerIdentity;
use HopHey\Rbac\Factories\PermissionFactory;
use PHPUnit\Framework\TestCase;

class PermissionFactoryTest extends TestCase
{
    private Identity $identity;
    
    protected function setUp(): void
    {
        $this->identity = new StaticIntegerIdentity(1);
    }


    public function testCreatePermission()
    {
        $factory = new PermissionFactory();
        $permission = $factory->create($this->identity, 'createPost');
        $this->assertEquals(2, $permission->getType());
        $this->assertInstanceOf(Permission::class, $permission);
    }
}
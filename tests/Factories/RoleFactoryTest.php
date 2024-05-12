<?php

namespace HopHey\Rbac\Tests\Factories;


use HopHey\Rbac\Contracts\Identity;
use HopHey\Rbac\Entities\Role;
use HopHey\Rbac\Entities\StaticIntegerIdentity;
use HopHey\Rbac\Factory\RoleFactory;
use PHPUnit\Framework\TestCase;

class RoleFactoryTest extends TestCase
{
    private Identity $identity;
    
    protected function setUp(): void
    {
        $this->identity = new StaticIntegerIdentity(1);
    }

    public function testCreateRole()
    {
        $factory = new RoleFactory();
        $role = $factory->create($this->identity, 'admin');
        $this->assertEquals(1, $role->getType());
        $this->assertInstanceOf(Role::class, $role);
    }
}
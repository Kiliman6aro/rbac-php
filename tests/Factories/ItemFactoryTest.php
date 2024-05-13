<?php
namespace HopHey\Rbac\Tests\Factories;

use HopHey\Rbac\Entities\Permission;
use HopHey\Rbac\Entities\Role;
use HopHey\Rbac\Entities\StaticIntegerIdentity;
use HopHey\Rbac\Factories\ItemFactory;
use PHPUnit\Framework\TestCase;

class ItemFactoryTest extends TestCase
{
    
    
    private ItemFactory $factory;
    
    /**
     * {@inheritDoc}
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    protected function setUp(): void
    {
        $this->factory = new ItemFactory();        
    }

    public function testCreateRole()
    {
        $role = $this->factory->createRole(new StaticIntegerIdentity(1), "admin");
        $this->assertInstanceOf(Role::class, $role);
        $this->assertEquals("admin", $role->getName());
        $this->assertEquals(1, $role->getId());
    }
    
    public function testCreatePermission() 
    {
        $permission = $this->factory->createPermission(new StaticIntegerIdentity(1), "createPost");
        $this->assertInstanceOf(Permission::class, $permission);
        $this->assertEquals("createPost", $permission->getName());
        $this->assertEquals(1, $permission->getId());
    }
}


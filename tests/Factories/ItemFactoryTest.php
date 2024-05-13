<?php
namespace HopHey\Rbac\Tests\Factories;

use HopHey\Rbac\Entities\Permission;
use HopHey\Rbac\Entities\Role;
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
        $role = $this->factory->createRole("admin");
        $this->assertInstanceOf(Role::class, $role);
        $this->assertEquals("admin", $role->getName());
    }
    
    public function testCreatePermission() 
    {
        $permission = $this->factory->createPermission("createPost");
        $this->assertInstanceOf(Permission::class, $permission);
        $this->assertEquals("createPost", $permission->getName());
    }
}


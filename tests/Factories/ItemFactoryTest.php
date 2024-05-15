<?php
namespace HopHey\Rbac\Tests\Factories;

use HopHey\Rbac\Entities\Permission;
use HopHey\Rbac\Entities\Role;
use HopHey\Rbac\Factories\ItemFactory;
use PHPUnit\Framework\TestCase;
use HopHey\Rbac\Entities\Item;

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
        $this->assertEquals(Item::TYPE_ROLE, $role->getType());
    }
    
    public function testCreatePermission() 
    {
        $permission = $this->factory->createPermission("createPost");
        $this->assertInstanceOf(Permission::class, $permission);
        $this->assertEquals("createPost", $permission->getName());
        $this->assertEquals(Item::TYPE_PERMISSION, $permission->getType());
    }
    
    public function testCreateRoleByData()
    {
        $role = $this->factory->createItemByData(['id' => 12345, 'name' => 'admin', 'type' => 1]);
        $this->assertInstanceOf(Role::class, $role);
        $this->assertEquals("admin", $role->getName());
        $this->assertEquals(12345, $role->getId());
        $this->assertEquals(Item::TYPE_ROLE, $role->getType());
    }
    
    public function testCreatePermissionByData()
    {
        $permission = $this->factory->createItemByData(['id' => 1, 'name' => 'createPost', 'type' => 2]);
        $this->assertInstanceOf(Permission::class, $permission);
        $this->assertEquals("createPost", $permission->getName());
        $this->assertEquals(1, $permission->getId());
        $this->assertEquals(Item::TYPE_PERMISSION, $permission->getType());
    }
    
    public function testCreateItemWitUnknownType()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->factory->createItemByData(['id' => 12345, 'name' => 'role', 'type' => -1]);
    }
}


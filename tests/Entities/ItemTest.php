<?php
namespace HopHey\Rbac\Tests\Entities;

use PHPUnit\Framework\TestCase;
use HopHey\Rbac\Entities\Role;
use HopHey\Rbac\Entities\Item;
use HopHey\Rbac\Entities\Permission;

class ItemTest extends TestCase
{
    
    public function testCreateRole()
    {
        $role = new Role('admin');
        $role->setId(1234);
        $this->assertEquals('admin', $role->getName());
        $this->assertEquals(1234, $role->getId());
        $this->assertEquals(Item::TYPE_ROLE, $role->getType());
    }
    
    
    public function testCreatePermission()
    {
        $permission = new Permission('createPost');
        $permission->setId(1);
        $this->assertEquals('createPost', $permission->getName());
        $this->assertEquals(1, $permission->getId());
        $this->assertEquals(Item::TYPE_PERMISSION, $permission->getType());
    }
    
    
    public function testSetName()
    {
        $permission = new Permission('createPost');
        $permission->setId(1);
        $this->assertEquals('createPost', $permission->getName());
        $this->assertEquals(1, $permission->getId());
        $this->assertEquals(Item::TYPE_PERMISSION, $permission->getType());
        
        $permission->setName('updatePost');
        $this->assertEquals('updatePost', $permission->getName());
    }
}


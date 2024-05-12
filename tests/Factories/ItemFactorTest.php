<?php

namespace HopHey\Rbac\Tests\Factories;

use PHPUnit\Framework\TestCase;
use HopHey\Rbac\Factory\ItemFactory;
use HopHey\Rbac\Entities\StaticIntegerIdentity;
use HopHey\Rbac\Contracts\Identity;
use HopHey\Rbac\Entities\Item;

class ItemFactorTest extends TestCase
{
    private Identity $identity;
    
    protected function setUp(): void
    {
        $this->identity = new StaticIntegerIdentity(1);   
    }
    
    public function testCreateRoleByItem()
    {
        $factory = new ItemFactory();
        $role = $factory->create($this->identity, 'admin', Item::TYPE_ROLE);
        $this->assertEquals(1, $role->getId());
        $this->assertEquals('admin', $role->getName());
        $this->assertEquals(1, $role->getType());
    }

    public function testCreatePermissionByItem()
    {
        $factory = new ItemFactory();
        $role = $factory->create($this->identity, 'createPost', Item::TYPE_PERMISSION);
        $this->assertEquals(1, $role->getId());
        $this->assertEquals('createPost', $role->getName());
        $this->assertEquals(2, $role->getType());
    }
}


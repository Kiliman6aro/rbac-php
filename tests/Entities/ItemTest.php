<?php

namespace HopHey\Rbac\Tests\Entities;

use HopHey\Rbac\Entities\Item;
use HopHey\Rbac\Entities\StaticIntegerIdentity;

use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    public function testGetId()
    {
        $item = $this->createItem(1, "admin", Item::TYPE_ROLE);
        $this->assertEquals(1, $item->getId());
        $this->assertIsString($item->getId());
    }

    public function testGetIdWithStringCatchTypeError()
    {
        $id = uniqid();
        $this->expectException(\TypeError::class);
        $item = $this->createItem($id, "moderator", Item::TYPE_ROLE);
    }

    public function testGetName()
    {
        $roleName = "admin";
        $item = $this->createItem(1, $roleName, Item::TYPE_ROLE);
        $this->assertEquals($roleName, $item->getName());
    }

    public function testGetTypeRole()
    {
        $type = Item::TYPE_ROLE;
        $roleName = "moderator";
        $id = 1;
        $item = $this->createItem($id, $roleName, $type);
        $this->assertEquals($type, $item->getType());
    }


    public function testGetTypePermission()
    {
        $type = Item::TYPE_PERMISSION;
        $roleName = "moderator";
        $id = 1;
        $item = $this->createItem($id, $roleName, $type);
        $this->assertEquals($type, $item->getType());
    }


    private function createItem(int|string $id, string $name, int $type): Item
    {
        $identity = new StaticIntegerIdentity($id);
        $item = new Item($identity, $name, $type);
        return $item;
    }
}
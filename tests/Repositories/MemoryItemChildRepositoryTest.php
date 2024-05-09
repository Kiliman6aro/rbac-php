<?php

use HopHey\Rbac\Entities\Item;
use HopHey\Rbac\Entities\StaticIntegerIdentity;
use HopHey\Rbac\Repositories\MemoryItemChildRepository;
use PHPUnit\Framework\TestCase;

class MemoryItemChildRepositoryTest extends TestCase
{

    private MemoryItemChildRepository $memoryItemChildRepository;
    protected function setUp(): void
    {
        $this->memoryItemChildRepository = new MemoryItemChildRepository();
    }
    public function testInsert()
    {
        $parent = new Item(StaticIntegerIdentity::generate(1), "admin", Item::TYPE_ROLE);
        $child = new Item(StaticIntegerIdentity::generate(2), "edit", Item::TYPE_PERMISSION);
        $this->assertFalse($this->memoryItemChildRepository->existsParent($parent));
        $this->memoryItemChildRepository->insert($parent, $child);
        $this->assertTrue($this->memoryItemChildRepository->existsParent($parent));
        $this->assertTrue($this->memoryItemChildRepository->existsChildByParent($child, $parent));
    }

    public function testFindChildsByParent()
    {
        $parent = new Item(StaticIntegerIdentity::generate(1), "admin", Item::TYPE_ROLE);
        $this->memoryItemChildRepository->insert($parent, new Item(StaticIntegerIdentity::generate(2), "edit", Item::TYPE_PERMISSION));
        $this->memoryItemChildRepository->insert($parent, new Item(StaticIntegerIdentity::generate(3), "remvove", Item::TYPE_PERMISSION));
        $childs = $this->memoryItemChildRepository->findChildsByParent($parent);
        $this->assertCount(2, $childs);
    }

    public function testFindEmptyChildsByParent()
    {
        $parent = new Item(StaticIntegerIdentity::generate(1), "admin", Item::TYPE_ROLE);
        $childs = $this->memoryItemChildRepository->findChildsByParent($parent);
        $this->assertEmpty($childs);
    }

    public function testFindParentsByChild()
    {
        $adminRole = new Item(StaticIntegerIdentity::generate(1), "admin", Item::TYPE_ROLE);
        $managerRole = new Item(StaticIntegerIdentity::generate(2), "manager", Item::TYPE_ROLE);
        $edit = new Item(StaticIntegerIdentity::generate(4), "edit", Item::TYPE_PERMISSION);
        $insert = new Item(StaticIntegerIdentity::generate(3), "insert", Item::TYPE_PERMISSION);
        $remove = new Item(StaticIntegerIdentity::generate(5), "remvove", Item::TYPE_PERMISSION);
        $this->memoryItemChildRepository->insert($adminRole, $insert);
        $this->memoryItemChildRepository->insert($adminRole, $edit);
        $this->memoryItemChildRepository->insert($adminRole, $remove);

        $this->memoryItemChildRepository->insert($managerRole, $insert);
        $this->memoryItemChildRepository->insert($managerRole, $edit);
        $parents = $this->memoryItemChildRepository->findParentsByChild($edit);
        $this->assertCount(2, $parents);
        
        $parents = $this->memoryItemChildRepository->findParentsByChild($remove);
        $this->assertCount(1, $parents);

    }

    public function testRemoveAllChildsByParent()
    {
        $adminRole = new Item(StaticIntegerIdentity::generate(1), "admin", Item::TYPE_ROLE);
        $edit = new Item(StaticIntegerIdentity::generate(4), "edit", Item::TYPE_PERMISSION);
        $insert = new Item(StaticIntegerIdentity::generate(3), "insert", Item::TYPE_PERMISSION);
        $remove = new Item(StaticIntegerIdentity::generate(5), "remvove", Item::TYPE_PERMISSION);
        $this->memoryItemChildRepository->insert($adminRole, $insert);
        $this->memoryItemChildRepository->insert($adminRole, $edit);
        $this->memoryItemChildRepository->insert($adminRole, $remove);

        $this->memoryItemChildRepository->removeAllChildsByParent($adminRole);
        $childs = $this->memoryItemChildRepository->findChildsByParent($adminRole);
        $this->assertCount(0, $childs);
    }

    public function testRemoveChildByParent()
    {
        $adminRole = new Item(StaticIntegerIdentity::generate(1), "admin", Item::TYPE_ROLE);
        $edit = new Item(StaticIntegerIdentity::generate(4), "edit", Item::TYPE_PERMISSION);

        $this->memoryItemChildRepository->insert($adminRole, $edit);
        $this->assertTrue($this->memoryItemChildRepository->existsParent($adminRole));
        $this->assertTrue($this->memoryItemChildRepository->existsChildByParent($edit, $adminRole));

        $this->memoryItemChildRepository->removeChildByParent($adminRole, $edit);
        $this->assertFalse($this->memoryItemChildRepository->existsChildByParent($edit, $adminRole));

    }
}
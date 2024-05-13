<?php

namespace HopHey\Rbac\Tests\Repositories;

use HopHey\Rbac\Entities\Permission;
use HopHey\Rbac\Entities\Role;
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
        $parent = new Role(StaticIntegerIdentity::generate(1), "admin");
        $child = new Permission(StaticIntegerIdentity::generate(2), "edit");
        $this->assertFalse($this->memoryItemChildRepository->existsParent($parent));
        $this->memoryItemChildRepository->insert($parent, $child);
        $this->assertTrue($this->memoryItemChildRepository->existsParent($parent));
        $this->assertTrue($this->memoryItemChildRepository->existsChildByParent($child, $parent));
    }

    public function testFindChildsByParent()
    {
        $parent = new Role(StaticIntegerIdentity::generate(1), "admin");
        $this->memoryItemChildRepository->insert($parent, new Permission(StaticIntegerIdentity::generate(2), "edit"));
        $this->memoryItemChildRepository->insert($parent, new Permission(StaticIntegerIdentity::generate(3), "remvove"));
        $childs = $this->memoryItemChildRepository->findChildsByParent($parent);
        $this->assertCount(2, $childs);
    }

    public function testFindEmptyChildsByParent()
    {
        $parent = new Role(StaticIntegerIdentity::generate(1), "admin");
        $childs = $this->memoryItemChildRepository->findChildsByParent($parent);
        $this->assertEmpty($childs);
    }

    public function testFindParentsByChild()
    {
        $adminRole = new Role(StaticIntegerIdentity::generate(1), "admin");
        $managerRole = new Role(StaticIntegerIdentity::generate(2), "manager");
        $edit = new Permission(StaticIntegerIdentity::generate(4), "edit");
        $insert = new Permission(StaticIntegerIdentity::generate(3), "insert");
        $remove = new Permission(StaticIntegerIdentity::generate(5), "remvove");
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
        $adminRole = new Role(StaticIntegerIdentity::generate(1), "admin");
        $edit = new Permission(StaticIntegerIdentity::generate(4), "edit");
        $insert = new Permission(StaticIntegerIdentity::generate(3), "insert");
        $remove = new Permission(StaticIntegerIdentity::generate(5), "remvove");
        $this->memoryItemChildRepository->insert($adminRole, $insert);
        $this->memoryItemChildRepository->insert($adminRole, $edit);
        $this->memoryItemChildRepository->insert($adminRole, $remove);

        $this->memoryItemChildRepository->removeAllChildsByParent($adminRole);
        $childs = $this->memoryItemChildRepository->findChildsByParent($adminRole);
        $this->assertCount(0, $childs);
    }

    public function testRemoveChildByParent()
    {
        $adminRole = new Role(StaticIntegerIdentity::generate(1), "admin");
        $edit = new Permission(StaticIntegerIdentity::generate(4), "edit");

        $this->memoryItemChildRepository->insert($adminRole, $edit);
        $this->assertTrue($this->memoryItemChildRepository->existsParent($adminRole));
        $this->assertTrue($this->memoryItemChildRepository->existsChildByParent($edit, $adminRole));

        $this->memoryItemChildRepository->removeChildByParent($adminRole, $edit);
        $this->assertFalse($this->memoryItemChildRepository->existsChildByParent($edit, $adminRole));

    }
}
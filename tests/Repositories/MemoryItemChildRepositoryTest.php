<?php

namespace HopHey\Rbac\Tests\Repositories;

use HopHey\Rbac\Entities\Permission;
use HopHey\Rbac\Entities\Role;
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
        $parent = new Role("admin");
        $child = new Permission("edit");
        $this->assertFalse($this->memoryItemChildRepository->existsParent($parent));
        $this->memoryItemChildRepository->insert($parent, $child);
        $this->assertTrue($this->memoryItemChildRepository->existsParent($parent));
        $this->assertTrue($this->memoryItemChildRepository->existsChildByParent($child, $parent));
    }

    public function testFindChildsByParent()
    {
        $parent = new Role("admin");
        $this->memoryItemChildRepository->insert($parent, new Permission("edit"));
        $this->memoryItemChildRepository->insert($parent, new Permission("remvove"));
        $childs = $this->memoryItemChildRepository->findChildsByParent($parent);
        $this->assertCount(2, $childs);
    }

    public function testFindEmptyChildsByParent()
    {
        $parent = new Role("admin");
        $childs = $this->memoryItemChildRepository->findChildsByParent($parent);
        $this->assertEmpty($childs);
    }

    public function testFindParentsByChild()
    {
        $adminRole = new Role("admin");
        $managerRole = new Role("manager");
        $edit = new Permission("edit");
        $insert = new Permission("insert");
        $remove = new Permission("remvove");
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
        $adminRole = new Role("admin");
        $edit = new Permission("edit");
        $insert = new Permission("insert");
        $remove = new Permission("remvove");
        $this->memoryItemChildRepository->insert($adminRole, $insert);
        $this->memoryItemChildRepository->insert($adminRole, $edit);
        $this->memoryItemChildRepository->insert($adminRole, $remove);

        $this->memoryItemChildRepository->removeAllChildsByParent($adminRole);
        $childs = $this->memoryItemChildRepository->findChildsByParent($adminRole);
        $this->assertCount(0, $childs);
    }

    public function testRemoveChildByParent()
    {
        $adminRole = new Role("admin");
        $edit = new Permission("edit");

        $this->memoryItemChildRepository->insert($adminRole, $edit);
        $this->assertTrue($this->memoryItemChildRepository->existsParent($adminRole));
        $this->assertTrue($this->memoryItemChildRepository->existsChildByParent($edit, $adminRole));

        $this->memoryItemChildRepository->removeChildByParent($adminRole, $edit);
        $this->assertFalse($this->memoryItemChildRepository->existsChildByParent($edit, $adminRole));

    }
}
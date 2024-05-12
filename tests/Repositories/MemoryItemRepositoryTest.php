<?php

namespace HopHey\Rbac\Tests\Repositories;

use HopHey\Rbac\Entities\Item;
use HopHey\Rbac\Entities\StaticIntegerIdentity;
use HopHey\Rbac\Exceptions\AlreadyItemExistsException;
use HopHey\Rbac\Exceptions\NotFoundItemException;
use HopHey\Rbac\Repositories\MemoryItemRepository;
use PHPUnit\Framework\TestCase;

class MemoryItemRepositoryTest extends TestCase
{

    private MemoryItemRepository $memoryItemRepository;
    protected function setUp(): void
    {
        $this->memoryItemRepository = new MemoryItemRepository();

        $id = 1;
        $item = $this->createItem($id);
        $this->memoryItemRepository->insert($item);
    }


    public function testInsertNewItemToRepository()
    {
        $id = 10;
        $item = $this->createItem($id);
        $this->memoryItemRepository->insert($item);
        $this->assertTrue($this->memoryItemRepository->exists($id));
    }

    public function testCatchAlreadyExistsException()
    {
        $id = 1;
        $item = $this->createItem($id);
        $this->expectException(AlreadyItemExistsException::class);
        $this->memoryItemRepository->insert($item);
    }

    public function testUpdateItem()
    {
        $id = 10;
        $item = $this->createItem($id);
        $this->memoryItemRepository->insert($item);
        $this->assertTrue($this->memoryItemRepository->exists($id));
        $newName = "manager";
        $item->setName($newName);
        $newItem = $this->memoryItemRepository->update($item);
        $this->assertEquals($newName, $newItem->getName());

    }

    public function testUpdateItemNotFoundException()
    {        
        $newItem = $this->createItem(2);
        $newItem->setName("manager");
        $this->expectException(NotFoundItemException::class);
        $this->memoryItemRepository->update($newItem);

    }

    public function testFindById()
    {
        $id = 1;
        $findedItem = $this->memoryItemRepository->findById($id);
        $this->assertInstanceOf(Item::class, $findedItem);
        $this->assertEquals($id, $findedItem->getId());
    }


    public function testFindByIdReturnedNull()
    {
        $findedItem = $this->memoryItemRepository->findById(-2);
        $this->assertNull($findedItem);
    }


    public function testRemoveItem()
    {
        $id = 1;
        $item = $this->memoryItemRepository->findById($id);
        $this->memoryItemRepository->remove($item);
        $this->assertFalse($this->memoryItemRepository->exists($id));
    }


    public function testRemoveItemCathNotFoundException()
    {
        $id = -1;
        $item = $this->createItem($id);
        $this->expectException(NotFoundItemException::class);
        $this->memoryItemRepository->remove($item);
    }

    private function createItem(int $id): Item
    {
        $identity = new StaticIntegerIdentity($id);
        $item = new Item($identity, "admin", Item::TYPE_ROLE);
        return $item;
    }
}
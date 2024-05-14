<?php

namespace HopHey\Rbac\Tests\Repositories;

use HopHey\Rbac\Entities\Item;
use HopHey\Rbac\Entities\Role;
use HopHey\Rbac\Exceptions\NotFoundItemException;
use HopHey\Rbac\Repositories\ItemRepository;
use PHPUnit\Framework\TestCase;

class MemoryItemRepositoryTest extends TestCase
{

    private ItemRepository $memoryItemRepository;
    
    protected function setUp(): void
    {
        $this->memoryItemRepository = new ItemRepository();

        $item = $this->createItem('admin');
        $item->setId(1);
        $this->memoryItemRepository->insert($item);
    }


    public function testInsertNewItemToRepository()
    {
        $item = $this->createItem('moderator');
        $this->memoryItemRepository->insert($item);
        $this->assertTrue($this->memoryItemRepository->existsByName('moderator'));
    }

    public function testUpdateItem()
    {
        $item = $this->memoryItemRepository->findByName('admin');
        $id = $item->getId();
        
        $this->assertTrue($this->memoryItemRepository->existsById($id));
        $newName = "manager";
        $item->setName($newName);
        $newItem = $this->memoryItemRepository->update($item);
        $this->assertEquals($newName, $newItem->getName());

    }

    public function testUpdateItemNotFoundException()
    {        
        $newItem = $this->createItem('manager');
        $newItem->setId(uniqid());
        $newItem->setName("manager");
        $this->expectException(NotFoundItemException::class);
        $this->memoryItemRepository->update($newItem);

    }

    public function testFindById()
    {
        $item = $this->memoryItemRepository->findByName('admin');
        $id = $item->getId();
        $findedItem = $this->memoryItemRepository->findById($id);
        $this->assertInstanceOf(Item::class, $findedItem);
        $this->assertEquals($id, $findedItem->getId());
    }
    
    
    public function testFindByName()
    {
        $item = $this->memoryItemRepository->findByName('admin');
        $this->assertInstanceOf(Item::class, $item);
        $this->assertEquals('admin', $item->getName());
        
    }


    public function testFindByIdReturnedNull()
    {
        $findedItem = $this->memoryItemRepository->findById(-2);
        $this->assertNull($findedItem);
    }


    public function testRemoveItem()
    {
        $item = $this->memoryItemRepository->findByName('admin');
        $this->memoryItemRepository->remove($item);
        $this->assertFalse($this->memoryItemRepository->existsByName('admin'));
    }


    public function testRemoveItemCathNotFoundException()
    {
        $item = $this->createItem('manager');
        $item->setId(-1);
        $this->expectException(NotFoundItemException::class);
        $this->memoryItemRepository->remove($item);
    }

    private function createItem(string $name): Item
    {
        return new Role($name);
    }
}
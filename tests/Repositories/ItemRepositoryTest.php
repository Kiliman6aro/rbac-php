<?php

namespace HopHey\Rbac\Tests\Repositories;

use HopHey\Rbac\Entities\Item;
use HopHey\Rbac\Entities\Role;
use HopHey\Rbac\Repositories\ItemRepository;
use PHPUnit\Framework\TestCase;
use HopHey\Rbac\Contracts\Factories\ItemFactory;
use HopHey\Rbac\Contracts\Providers\DataProvider;

class ItemRepositoryTest extends TestCase
{
    public function testInsert()
    {
        $dataProviderMock = $this->createMock(DataProvider::class);
        $itemFactoryMock = $this->createMock(ItemFactory::class);
        
        $item = new Role('admin');
        $itemRepository = new ItemRepository($dataProviderMock, $itemFactoryMock);
       
        
        $dataProviderMock->expects($this->once())
        ->method('insert')
        ->with([
            'name' => 'admin',
            'type' => Item::TYPE_ROLE
        ])
        ->willReturn([
            'id' => '12345',
            'name' => 'admin',
            'type' => Item::TYPE_ROLE
        ]);
        
        $result = $itemRepository->insert($item);
        
        $this->assertEquals('12345', $result->getId());
        $this->assertEquals('admin', $result->getName());
        $this->assertEquals(Item::TYPE_ROLE, $result->getType());
    }
    
    
    
    public function testUpdate()
    {
        $dataProviderMock = $this->createMock(DataProvider::class);
        $itemFactoryMock = $this->createMock(ItemFactory::class);
        
        $itemRepository = new ItemRepository($dataProviderMock, $itemFactoryMock);
       
        
        $dataProviderMock->expects($this->once())
        ->method('exists')
        ->with(['id' => 12345])
        ->willReturn(true);
        
        $dataProviderMock->expects($this->once())
        ->method('update')
        ->with(
            $this->equalTo(['id' => 12345]),
            $this->equalTo(['id' => 12345, 'name' => 'manager', 'type' => Item::TYPE_ROLE])
        )
        ->willReturn(1);
        
        $item = new Role('manager');
        $item->setId(12345);
        
        $result = $itemRepository->update($item);
        
        $this->assertEquals(12345, $result->getId());
        $this->assertEquals('manager', $result->getName());
        $this->assertEquals(Item::TYPE_ROLE, $result->getType());
    }
    
    
    public function testRemove()
    {
        $dataProviderMock = $this->createMock(DataProvider::class);
        $itemFactoryMock = $this->createMock(ItemFactory::class);
        
        $itemRepository = new ItemRepository($dataProviderMock, $itemFactoryMock);
        
        
        $dataProviderMock->expects($this->once())
        ->method('exists')
        ->with(['id' => 12345])
        ->willReturn(true);
        
        $dataProviderMock->expects($this->once())
        ->method('delete')
        ->with($this->equalTo(['id' => 12345]))
        ->willReturn(1);
        
        $item = new Role('admin');
        $item->setId(12345);
        $this->assertTrue($itemRepository->remove($item));
        
    }
    
    public function testFindById()
    {
        $dataProviderMock = $this->createMock(DataProvider::class);
        $itemFactoryMock = $this->createMock(ItemFactory::class);
        
        $itemRepository = new ItemRepository($dataProviderMock, $itemFactoryMock);
        
        $dataProviderMock->expects($this->once())
        ->method('exists')
        ->with(['id' => 12345])
        ->willReturn(true);
        
        
        $dataProviderMock->expects($this->once())
        ->method('findBy')
        ->with($this->equalTo(['id' => 12345]))
        ->willReturn(
            [
                ['id' => 12345, 'name' => 'admin', 'type' => Item::TYPE_ROLE]
                
            ]
        );
        
        $item = new Role('admin');
        $item->setId(12345);
        
        $itemFactoryMock->expects($this->once())
        ->method('createItemByData')
        ->with(['id' => 12345, 'name' => 'admin', 'type' => Item::TYPE_ROLE])
        ->willReturn($item);
        
        $result = $itemRepository->findById(12345);
        
        $this->assertEquals(12345, $result->getId());
        $this->assertEquals('admin', $result->getName());
        $this->assertEquals(Item::TYPE_ROLE, $result->getType());
    }
    
    public function testFindByName()
    {
        $dataProviderMock = $this->createMock(DataProvider::class);
        $itemFactoryMock = $this->createMock(ItemFactory::class);
        
        $itemRepository = new ItemRepository($dataProviderMock, $itemFactoryMock);
        
        $dataProviderMock->expects($this->once())
        ->method('exists')
        ->with(['name' => 'admin'])
        ->willReturn(true);
        
        
        $dataProviderMock->expects($this->once())
        ->method('findBy')
        ->with($this->equalTo(['name' => 'admin']))
        ->willReturn(
            [
                ['id' => 12345, 'name' => 'admin', 'type' => Item::TYPE_ROLE]
                
            ]
            );
        
        $item = new Role('admin');
        $item->setId(12345);
        
        $itemFactoryMock->expects($this->once())
        ->method('createItemByData')
        ->with(['id' => 12345, 'name' => 'admin', 'type' => Item::TYPE_ROLE])
        ->willReturn($item);
        
        $result = $itemRepository->findByName('admin');
        
        $this->assertEquals(12345, $result->getId());
        $this->assertEquals('admin', $result->getName());
        $this->assertEquals(Item::TYPE_ROLE, $result->getType());
    }
    
    
    public function testExistsById()
    {
        $dataProviderMock = $this->createMock(DataProvider::class);
        $itemFactoryMock = $this->createMock(ItemFactory::class);
        
        $itemRepository = new ItemRepository($dataProviderMock, $itemFactoryMock);
        
        $dataProviderMock->expects($this->once())
        ->method('exists')
        ->with(['id' => 12345])
        ->willReturn(true);
        
        $this->assertTrue($itemRepository->existsById(12345));
        
    }
    
    public function testExistsByName()
    {
        $dataProviderMock = $this->createMock(DataProvider::class);
        $itemFactoryMock = $this->createMock(ItemFactory::class);
        
        $itemRepository = new ItemRepository($dataProviderMock, $itemFactoryMock);
        
        $dataProviderMock->expects($this->once())
        ->method('exists')
        ->with(['name' => 'admin'])
        ->willReturn(true);
        
        $this->assertTrue($itemRepository->existsByName('admin'));
        
    }
    
    private function createItem(string $name): Item
    {
        return new Role($name);
    }
}
<?php

namespace HopHey\Rbac\Repositories;

use HopHey\Rbac\Contracts\Repositories\ItemRepositoryContract;
use HopHey\Rbac\Entities\Item;
use HopHey\Rbac\Exceptions\NotFoundItemException;

class ItemRepository implements ItemRepositoryContract
{
    private array $collection = [];

    public function insert(Item $item): Item
    {
        $item->setId(uniqid());
        $this->collection[$item->getId()] = $item;
        return $item;
    }
    public function update(Item $item): Item
    {
        if(!$this->existsById($item->getId())){
            throw new NotFoundItemException();
        }
        $this->collection[$item->getId()] = $item;
        return $item;
    }
    public function remove(Item $item): void
    {
        if(!$this->existsById($item->getId())){
            throw new NotFoundItemException();
        }
        unset($this->collection[$item->getId()]);
    }

    public function findById($id): ?Item
    {
        if(!$this->existsById($id)){
            return null;
        }
        return $this->collection[$id];
    }
    
    public function findByName(string $name): ?Item
    {
        foreach ($this->collection as $item){
            if($item->getName() == $name){
                return $item;
            }
        }
    }

    public function existsById(int|string $id): bool
    {
        return isset($this->collection[$id]);
    }
    
    
    public function existsByName(string $name): bool
    {
        foreach ($this->collection as $item){
            if($item->getName() == $name){
                return true;
            }
        }
        return false;
    }
}
<?php

namespace HopHey\Rbac\Repositories;

use HopHey\Rbac\Contracts\Repositories\ItemRepository;
use HopHey\Rbac\Entities\Item;
use HopHey\Rbac\Exceptions\AlreadyItemExistsException;
use HopHey\Rbac\Exceptions\NotFoundItemException;

class MemoryItemRepository implements ItemRepository
{
    private array $collection = [];

    public function insert(Item $item): void
    {
        if($this->exists($item->getId())){
            throw new AlreadyItemExistsException(sprintf("Item with id: %s is already exists.", $item->getId()));
        }
        $this->collection[$item->getId()] = $item;
    }
    public function update(Item $item): Item
    {
        if(!$this->exists($item->getId())){
            throw new NotFoundItemException(sprintf("Item with id: %s not found.", $item->getId()));
        }
        $this->collection[$item->getId()] = $item;
        return $item;
    }
    public function remove(Item $item): void
    {
        if(!$this->exists($item->getId())){
            throw new NotFoundItemException(sprintf("Item with id: %s not found.", $item->getId()));
        }
        unset($this->collection[$item->getId()]);
    }

    public function findById($id): ?Item
    {
        if(!$this->exists($id)){
            return null;
        }
        return $this->collection[$id];
    }

    public function exists($id): bool
    {
        return isset($this->collection[$id]);
    }
}
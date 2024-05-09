<?php

namespace HopHey\Rbac\Repositories;

use HopHey\Rbac\Contracts\Repositories\ItemChildRepository;
use HopHey\Rbac\Entities\Item;

class MemoryItemChildRepository implements ItemChildRepository
{
    private array $collection = [];

    public function insert(Item $parent, Item $child): void
    {
        if(!$this->existsChildByParent($child, $parent)){
            $this->collection[$parent->getName()][] = $child;
        }
    }

    public function findChildsByParent(Item $parent): array
    {
        if($this->existsParent($parent)){
            return $this->collection[$parent->getName()];
        }
        return [];
    }

    public function findParentsByChild(Item $child): array
    {
        $keys = [];
        foreach ($this->collection as $subarray) {
            foreach($subarray as $currentChild){
                if($currentChild->getName() === $child->getName()){
                    $keys[] = $currentChild;
                }
            }
        }
        return $keys;
    }

    public function removeAllChildsByParent(Item $parent): void
    {
        if($this->existsParent($parent)){
            $this->collection[$parent->getName()] = [];
        }
    }

    public function removeChildByParent(Item $parent, Item $child): void
    {
        if($this->existsParent($parent)){
            foreach($this->collection[$parent->getName()] as $key => $currentChild){
                if($currentChild->getName() === $child->getName()){
                    unset($this->collection[$parent->getName()][$key]);
                }
            }
        }
    }

    public function existsParent(Item $parent): bool
    {
        return isset($this->collection[$parent->getName()]);
    }


    public function existsChildByParent(Item $child, Item $parent): bool
    {
        if($this->existsParent($parent)){
            foreach($this->collection[$parent->getName()] as $currentChild){
                if($currentChild->getName() === $child->getName()){
                    return true;
                }
            }
        }
        return false;
    }
}
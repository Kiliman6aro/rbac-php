<?php

namespace HopHey\Rbac\Contracts\Repositories;

use HopHey\Rbac\Entities\Item;

interface ItemRepository
{
    public function insert(Item $item): Item;
    
    public function update(Item $item): Item;
    
    public function remove(Item $item): void;
    
    public function findById($id): ?Item;
    
    public function findByName(string $name): ?Item;

    public function existsById(int|string $id): bool;
    
    public function existsByName(string $name): bool;
    
}
<?php

namespace HopHey\Rbac\Contracts\Repositories;

use HopHey\Rbac\Entities\Item;

interface ItemRepository
{
    public function insert(Item $item): void;
    public function update(Item $item): Item;
    public function remove(Item $item): void;
    public function findById($id): ?Item;

    public function exists($id): bool;
}
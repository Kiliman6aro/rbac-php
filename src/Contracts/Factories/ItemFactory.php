<?php

namespace HopHey\Rbac\Contracts\Factories;

use HopHey\Rbac\Entities\Item;

interface ItemFactory
{
    public function createItemByData(array $data): Item;
    
    public function createRole(string $name): Item;
    
    public function createPermission(string $name): Item;
    
}


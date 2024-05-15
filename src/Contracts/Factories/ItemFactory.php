<?php

namespace HopHey\Rbac\Contracts\Factories;

use HopHey\Rbac\Entities\Permission;
use HopHey\Rbac\Entities\Role;
use HopHey\Rbac\Entities\Item;

interface ItemFactory
{
    public function createItemByData(array $data): Item;
    
    public function createRole(string $name): Role;
    
    public function createPermission(string $name): Permission;
    
}


<?php
namespace HopHey\Rbac\Factories;

use HopHey\Rbac\Contracts\Factories\ItemFactory;
use HopHey\Rbac\Contracts\Identity;
use HopHey\Rbac\Entities\Item;
use HopHey\Rbac\Entities\Role;

class RoleFactory implements ItemFactory
{
    public function create(Identity $identity, string $name, int $type = null): Role
    {
        return new Role($identity, $name, Item::TYPE_ROLE);
    }
    
}


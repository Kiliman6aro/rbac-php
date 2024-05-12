<?php
namespace HopHey\Rbac\Factory;

use HopHey\Rbac\Contracts\Identity;
use HopHey\Rbac\Entities\Item;
use HopHey\Rbac\Entities\Role;

class RoleFactory extends ItemFactory
{
    public function create(Identity $identity, string $name, int $type = null): Role
    {
        return new Role($identity, $name, Item::TYPE_ROLE);
    }
    
}


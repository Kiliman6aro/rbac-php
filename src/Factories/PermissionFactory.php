<?php
namespace HopHey\Rbac\Factories;

use HopHey\Rbac\Contracts\Factories\ItemFactory;
use HopHey\Rbac\Contracts\Identity;
use HopHey\Rbac\Entities\Item;
use HopHey\Rbac\Entities\Permission;

class PermissionFactory implements ItemFactory
{
    public function create(Identity $identity, string $name, int $type = null): Permission
    {
        return new Permission($identity, $name, Item::TYPE_PERMISSION);
    }
}


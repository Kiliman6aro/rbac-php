<?php
namespace HopHey\Rbac\Factory;

use HopHey\Rbac\Contracts\Identity;
use HopHey\Rbac\Entities\Item;
use HopHey\Rbac\Entities\Permission;

class PermissionFactory extends ItemFactory
{
    public function create(Identity $identity, string $name, int $type = null): Permission
    {
        return new Permission($identity, $name, Item::TYPE_PERMISSION);
    }
}


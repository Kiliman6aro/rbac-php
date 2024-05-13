<?php
namespace HopHey\Rbac\Factories;

use HopHey\Rbac\Contracts\Factories\ItemFactoryContract;
use HopHey\Rbac\Contracts\Identity;
use HopHey\Rbac\Entities\Permission;
use HopHey\Rbac\Entities\Role;
use HopHey\Rbac\Entities\Item;

class ItemFactory implements ItemFactoryContract
{

    public function createRole(Identity $identity, $name): Role
    {
        return new Role($identity, $name);
    }

    public function createPermission(Identity $identity, $name): Permission
    {
        return new Permission($identity, $name);
    }
}


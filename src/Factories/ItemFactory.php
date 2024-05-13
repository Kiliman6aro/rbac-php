<?php
namespace HopHey\Rbac\Factories;

use HopHey\Rbac\Contracts\Factories\ItemFactoryContract;
use HopHey\Rbac\Entities\Permission;
use HopHey\Rbac\Entities\Role;

class ItemFactory implements ItemFactoryContract
{

    public function createRole($name): Role
    {
        return new Role($name);
    }

    public function createPermission($name): Permission
    {
        return new Permission($name);
    }
}


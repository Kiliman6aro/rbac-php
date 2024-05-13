<?php

namespace HopHey\Rbac\Contracts\Factories;

use HopHey\Rbac\Contracts\Identity;
use HopHey\Rbac\Entities\Item;
use HopHey\Rbac\Entities\Role;
use HopHey\Rbac\Entities\Permission;

interface ItemFactoryContract
{
    public function createRole(Identity $identity, string $name): Role;
    
    public function createPermission(Identity $identity, string $name): Permission;
    
}


<?php

namespace HopHey\Rbac\Contracts\Factories;

use HopHey\Rbac\Entities\Permission;
use HopHey\Rbac\Entities\Role;

interface ItemFactoryContract
{
    public function createRole(string $name): Role;
    
    public function createPermission(string $name): Permission;
    
}


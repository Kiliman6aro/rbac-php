<?php
namespace HopHey\Rbac\Contracts\Services;

use HopHey\Rbac\Entities\Role;
use HopHey\Rbac\Entities\Permission;
use HopHey\Rbac\Entities\Item;

interface AuthManagerService
{
    public function addRole(Role $role): void;
    
    public function addPermission(Permission $permission): void;
    
    public function addChild(Item $parent, Item $child): void;
}


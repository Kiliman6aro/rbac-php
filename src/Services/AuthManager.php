<?php
namespace HopHey\Rbac\Services;

use HopHey\Rbac\Contracts\Services\AuthManager as AuthManagerContract;
use HopHey\Rbac\Entities\Permission;
use HopHey\Rbac\Entities\Item;
use HopHey\Rbac\Entities\Role;
use HopHey\Rbac\Contracts\Repositories\ItemRepository;
use HopHey\Rbac\Contracts\Repositories\ItemChildRepository;

class AuthManager implements AuthManagerContract
{
    protected ItemRepository $itemRepository;
    
    protected ItemChildRepository $itemChildRepository;
    
    public function __construct(ItemRepository $itemRepository, ItemChildRepository $itemChildRepository)
    {
        $this->itemRepository = $itemRepository;
        $this->itemChildRepository = $itemChildRepository;
    }

    public function addPermission(Permission $permission): void
    {
        $this->itemRepository->insert($permission);
    }

    public function addChild(Item $parent, Item $child): void
    {
        $this->itemChildRepository->insert($parent, $child);
    }

    public function addRole(Role $role): void
    {
        $this->itemRepository->insert($role);
    }
}


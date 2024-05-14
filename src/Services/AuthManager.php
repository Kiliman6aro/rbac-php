<?php
namespace HopHey\Rbac\Services;

use HopHey\Rbac\Contracts\Services\AuthManagerService;
use HopHey\Rbac\Entities\Permission;
use HopHey\Rbac\Entities\Item;
use HopHey\Rbac\Entities\Role;
use HopHey\Rbac\Contracts\Repositories\ItemRepositoryContract;
use HopHey\Rbac\Contracts\Repositories\ItemChildRepository;

class AuthManager implements AuthManagerService
{
    protected ItemRepositoryContract $itemRepository;
    
    protected ItemChildRepository $itemChildRepository;
    
    public function __construct(ItemRepositoryContract $itemRepository, ItemChildRepository $itemChildRepository)
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


<?php
namespace HopHey\Rbac\Factories;

use HopHey\Rbac\Entities\Permission;
use HopHey\Rbac\Entities\Role;
use HopHey\Rbac\Entities\Item;

class ItemFactory implements \HopHey\Rbac\Contracts\Factories\ItemFactory
{

    public function createItemByData(array $data): Item 
    {
        switch ($data['type']) {
            case Item::TYPE_ROLE:
                $item = $this->createRole($data['name']);
                break;
            case Item::TYPE_PERMISSION:
                $item = $this->createPermission($data['name']);
                break;
            default:
                throw new \InvalidArgumentException("Unknown item type: " . $data['type']);
        }
        
        $item->setId($data['id']);
        return $item;
    }

    public function createRole($name): Item
    {
        return new Role($name);
    }

    public function createPermission($name): Item
    {
        return new Permission($name);
    }
}


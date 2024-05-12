<?php
namespace HopHey\Rbac\Factory;

use HopHey\Rbac\Contracts\Identity;
use HopHey\Rbac\Entities\Item;

class ItemFactory
{
    public function create(Identity $identity, string $name, int $type): Item
    {
        return new Item($identity, $name, $type);
    }
}


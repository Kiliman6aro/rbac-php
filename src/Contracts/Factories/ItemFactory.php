<?php

namespace HopHey\Rbac\Contracts\Factories;

use HopHey\Rbac\Contracts\Identity;
use HopHey\Rbac\Entities\Item;

interface ItemFactory
{
    public function create(Identity $identity, string $name, int $type): Item;
}


<?php

namespace HopHey\Rbac\Contracts\Repositories;

use HopHey\Rbac\Entities\Item;

interface ItemChildRepository 
{
    public function insert(Item $parent, Item $child): void;

    public function findChildsByParent(Item $parent): array;

    public function findParentsByChild(Item $child): array;

    public function removeAllChildsByParent(Item $parent): void;

    public function removeChildByParent(Item $parent, Item $child): void;

    public function existsParent(Item $parent): bool;

    public function existsChildByParent(Item $child, Item $parent): bool;
}
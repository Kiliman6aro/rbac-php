<?php

namespace HopHey\Rbac\Entities;

use HopHey\Rbac\Contracts\Identity;

class StaticIntegerIdentity implements Identity
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public static function generate(int $id): StaticIntegerIdentity
    {
        return new self($id);
    }

    public function toString(): string
    {
        return $this->id;
    }
}
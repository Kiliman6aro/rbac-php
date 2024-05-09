<?php

namespace HopHey\Rbac\Entities;

use HopHey\Rbac\Contracts\Identity;
use Ramsey\Uuid\Uuid;


class UUIDIdentity implements Identity
{
    private string $id;

    private function __construct(string $id)
    {
        $this->id = $id;
    }

    public static function generate(): UUIDIdentity
    {
        return new self(Uuid::uuid4()->toString());
    }

    public function toString(): string
    {
        return $this->id;
    }
}
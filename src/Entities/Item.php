<?php

namespace HopHey\Rbac\Entities;
use HopHey\Rbac\Contracts\Identity;

class Item
{
    public const TYPE_ROLE = 1;
    public const TYPE_PERMISSION = 2;

    private Identity $identity;
    private string $name;

    private int $type;

    /**
     * @param string $name
     */
    public function __construct(Identity $identity, string $name, int $type)
    {
        $this->identity = $identity;
        $this->name = $name;
        $this->type = $type;
    }

    public function getId(): string
    {
        return $this->identity->toString();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): int
    {
        return $this->type;
    }
}
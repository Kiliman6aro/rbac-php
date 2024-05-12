<?php

namespace HopHey\Rbac\Entities;
use HopHey\Rbac\Contracts\Identity;

class Item
{
    public const TYPE_ROLE = 1;
    public const TYPE_PERMISSION = 2;

    protected Identity $identity;
    protected string $name;

    protected int $type;

    /**
     * @param string $name
     */
    public function __construct(Identity $identity, string $name, ?int $type = null)
    {
        $this->identity = $identity;
        $this->name = $name;
        $this->type = $type;
    }

    public function getId(): string
    {
        return $this->identity->toString();
    }

    public function setName(string $name)
    {
        $this->name = $name;
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
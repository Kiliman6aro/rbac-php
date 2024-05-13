<?php

namespace HopHey\Rbac\Entities;

abstract class Item
{
    public const TYPE_ROLE = 1;
    
    public const TYPE_PERMISSION = 2;

    protected int|string $id;
    
    protected string $name;

    protected int $type;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }
    
    public function setId(int|string $id)
    {
        $this->id = $id;
    }

    public function getId(): int|string
    {
        return $this->id;
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
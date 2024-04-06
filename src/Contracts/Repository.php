<?php

namespace HopHey\Rbac\Contracts;

interface Repository
{
    public function insert(string $key): void;
    public function delete(string $key): void;
    public function exists(string $key): bool;
}
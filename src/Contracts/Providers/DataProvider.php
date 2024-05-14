<?php
namespace HopHey\Rbac\Contracts\Providers;

interface DataProvider
{
    public function findBy(array $criteria): array;
    
    public function insert(array $data): array;
    
    public function update(array $criteria, array $data): int;
    
    public function delete(array $criteria): int;
    
    public function exists(array $criteria): bool;
    
    public function count(array $criteria): int;
    
    public function all(): array;
}


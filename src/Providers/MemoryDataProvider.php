<?php
namespace HopHey\Rbac\Providers;

use HopHey\Rbac\Contracts\Providers\DataProvider;

class MemoryDataProvider implements DataProvider
{
    private $data = [];
    
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }
    
    public function all(): array
    {
        return $this->data;
    }


    public function findBy(array $criteria): array
    {
        $indices = $this->findMatchingIndices($criteria);
        $result = [];
        
        foreach ($indices as $index) {
            $result[] = $this->data[$index];
        }
        
        return $result;
    }

    public function insert(array $data): void
    {
        $this->data[] = $data;
    }
    
    public function count(array $criteria = null): int
    {
        if(empty($criteria)){
            return count($this->all());
        }
        return count($this->findMatchingIndices($criteria));
    }
    

    public function exists(array $criteria): bool
    {
        $indices = $this->findMatchingIndices($criteria);
        return count($indices) > 0;
    }
    
    
    public function update(array $criteria, array $data): int
    {
        $indices = $this->findMatchingIndices($criteria);
        
        foreach ($indices as $index) {
            $this->data[$index] = $data;
        }
        
        return count($indices);
    }


    public function delete(array $criteria): int
    {
        $indices = $this->findMatchingIndices($criteria);
        foreach($indices as $key){
            unset($this->data[$key]);
            $this->data = array_values($this->data);
        }
        return count($indices);
    }
    
    
    private function findMatchingIndices(array $criteria): array 
    {
        if (empty($criteria)) {
            throw new \InvalidArgumentException("Criteria cannot be empty.");
        }
        
        $result = [];
        $matches = false;
        
        foreach ($this->data as $index => $item) {
            $matches = true;
            
            foreach ($criteria as $key => $value) {
                if (is_array($value)) {
                    if (!isset($item[$key]) || !in_array($item[$key], $value)) {
                        $matches = false;
                        break;
                    }
                } else {
                    if (!isset($item[$key]) || $item[$key] !== $value) {
                        $matches = false;
                        break;
                    }
                }
            }
            
            if ($matches) {
                $result[] = $index;
            }
        }
        return $result;
    }

}


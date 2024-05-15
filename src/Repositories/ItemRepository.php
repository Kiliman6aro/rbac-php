<?php
namespace HopHey\Rbac\Repositories;

use HopHey\Rbac\Entities\Item;
use HopHey\Rbac\Exceptions\NotFoundItemException;
use HopHey\Rbac\Contracts\Providers\DataProvider;
use HopHey\Rbac\Contracts\Factories\ItemFactory;
use \HopHey\Rbac\Contracts\Repositories\ItemRepository as ItemRepositoryContract;

class ItemRepository implements ItemRepositoryContract
{

    private DataProvider $dataProvider;
    
    private ItemFactory $itemFactory;

    public function __construct(DataProvider $dataProvider, ItemFactory $itemFactory)
    {
        $this->dataProvider = $dataProvider;
        $this->itemFactory = $itemFactory;
    }

    /**
     */
    public function insert(Item $item): Item
    {
        $data = $this->dataProvider->insert([
            'name' => $item->getName(),
            'type' => $item->getType()
        ]);

        $item->setId($data['id']);

        return $item;
    }

    public function update(Item $item): Item
    {
        $criteria = [
            'id' => $item->getId()
        ];

        if ($this->dataProvider->exists($criteria)) {
            $updateData = [
                'id' => $item->getId(),
                'name' => $item->getName(),
                'type' => $item->getType()
            ];
            $this->dataProvider->update($criteria, $updateData);
            return $item;
        } else {
            throw new NotFoundItemException("Item with ID " . $item->getId() . " does not exist.");
        }
    }

    public function remove(Item $item): bool
    {
        $criteria = [
            'id' => $item->getId()
        ];

        if ($this->dataProvider->exists($criteria)) {

            $result = $this->dataProvider->delete($criteria);
            return $result > 0;
        } else {
            throw new NotFoundItemException("Item with ID " . $item->getId() . " does not exist.");
        }
    }

    public function findById($id): ?Item
    {
        return $this->findByCrieria(['id' => $id]);
    }

    public function findByName(string $name): ?Item
    {
        return $this->findByCrieria(['name' => $name]);
    }

    public function existsById(int|string $id): bool
    {
        return $this->dataProvider->exists(['id' => $id]);
    }
    
    
    public function existsByName(string $name): bool
    {
        return $this->dataProvider->exists(['name' => $name]);
    }
    
    /**
     * Find one only Item or null
     * @param array $criteria
     * @return Item|NULL
     */
    protected function findByCrieria(array $criteria): ?Item
    {
        if (!$this->dataProvider->exists($criteria)) {
            return null;
        }
        
        $data = $this->dataProvider->findBy($criteria);
        
        if (empty($data)) {
            return null;
        }
        
        $data = reset($data);
        try {
            return $this->itemFactory->createItemByData($data);
        } catch (\Exception $e) {
            return null;
        }
    }
}
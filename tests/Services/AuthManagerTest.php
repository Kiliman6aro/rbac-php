<?php
namespace HopHey\Rbac\Tests\Services;

use HopHey\Rbac\Contracts\Factories\ItemFactoryContract;
use HopHey\Rbac\Contracts\Repositories\ItemChildRepository;
use HopHey\Rbac\Contracts\Repositories\ItemRepository;
use HopHey\Rbac\Contracts\Services\AuthManagerService;
use HopHey\Rbac\Factories\ItemFactory;
use HopHey\Rbac\Services\AuthManager;
use PHPUnit\Framework\TestCase;

class AuthManagerTest extends TestCase
{
    private AuthManagerService $authManager;
    
    private ItemFactoryContract $factory;
    
    private ItemRepository $itemRepository;
    
    private ItemChildRepository $itemChildRepository;
    
    protected function setUp(): void
    {
        $this->itemChildRepository = $this->createMock(ItemChildRepository::class);
        $this->itemRepository = $this->createMock(ItemRepository::class);
        
        $this->authManager = new AuthManager($this->itemRepository, $this->itemChildRepository);
        $this->factory = new ItemFactory();
    }
    
    public function testAddRole()
    {
        $role = $this->factory->createRole('admin');
        $this->itemRepository->expects($this->once())
        ->method('insert')
        ->with($role);
        
        $this->authManager->addRole($role);
        
    }
    
    public function testAddPermission()
    {
        
        $permission = $this->factory->createPermission('createPost');
        $this->itemRepository->expects($this->once())
        ->method('insert')
        ->with($permission);
        
        $this->authManager->addPermission($permission);
    }
    
    
    public function testAddChild()
    {
        $role = $this->factory->createRole("admin");
        $permission = $this->factory->createPermission('createPost');
        
        $this->itemChildRepository->expects($this->once())
        ->method('insert')
        ->with($role, $permission);
        
        $this->authManager->addChild($role, $permission);
    }
}


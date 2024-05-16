<?php
namespace HopHey\Rbac\Tests\Services;

use HopHey\Rbac\Contracts\Repositories\ItemChildRepository;
use HopHey\Rbac\Contracts\Services\AuthManager as AuthManagerContract;
use HopHey\Rbac\Services\AuthManager;
use PHPUnit\Framework\TestCase;
use HopHey\Rbac\Contracts\Repositories\ItemRepository;
use HopHey\Rbac\Entities\Permission;
use HopHey\Rbac\Entities\Role;

class AuthManagerTest extends TestCase
{
    private AuthManagerContract $authManager;
    
    private ItemRepository $itemRepository;
    
    private ItemChildRepository $itemChildRepository;
    
    protected function setUp(): void
    {
        $this->itemChildRepository = $this->createMock(ItemChildRepository::class);
        $this->itemRepository = $this->createMock(ItemRepository::class);
        
        $this->authManager = new AuthManager($this->itemRepository, $this->itemChildRepository);
    }
    
    public function testAddRole()
    {
        $role = new Role("admin");
        $this->itemRepository->expects($this->once())
        ->method('insert')
        ->with($role);
        
        $this->authManager->addRole($role);
        
    }
    
    public function testAddPermission()
    {
        
        $permission = new Permission('createPost');
        $this->itemRepository->expects($this->once())
        ->method('insert')
        ->with($permission);
        
        $this->authManager->addPermission($permission);
    }
    
    
    public function testAddChild()
    {
        $role = new Role("admin");
        $permission = new Permission('createPost');
        
        $this->itemChildRepository->expects($this->once())
        ->method('insert')
        ->with($role, $permission);
        
        $this->authManager->addChild($role, $permission);
    }
}


<?php

use HopHey\Rbac\AuthorizationManager;
use HopHey\Rbac\Repositories\UsersRolesRepository;

class AuthorizationManagerTest extends \PHPUnit\Framework\TestCase
{
    protected AuthorizationManager $authorizationManager;

    protected function setUp(): void
    {
        $this->authorizationManager = new AuthorizationManager(new UsersRolesRepository());
    }

    public function testCanAssignRoleToUser()
    {
        $roleName = 'admin';
        $userName = 'admin';

        $this->authorizationManager->assignRoleToUser($roleName, $userName);
        $this->assertTrue($this->authorizationManager->userHasRole($userName, $roleName));
    }
}
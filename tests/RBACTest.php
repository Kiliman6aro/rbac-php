<?php

use HopHey\Rbac\RBAC;

class RBACTest extends \PHPUnit\Framework\TestCase
{
    protected RBAC $rbac;

    protected function setUp(): void
    {
        $this->rbac = new RBAC();
    }

    public function testCanCreateRole()
    {
        $roleName = 'admin';

        $this->assertFalse($this->rbac->roleExists($roleName));

        $this->rbac->createRole($roleName);

        $this->assertTrue($this->rbac->roleExists($roleName));

    }


    public function testCanDeleteRole()
    {
        $roleName = 'admin';

        $this->rbac->createRole($roleName);

        $this->assertTrue($this->rbac->roleExists($roleName));

        $this->rbac->deleteRole($roleName);

        $this->assertFalse($this->rbac->roleExists($roleName));
    }

    public function testCanCreatePermission()
    {
        $permissionName = 'editPost';

        $this->rbac->createPermission($permissionName);

        $this->assertTrue($this->rbac->permissionExists($permissionName));
    }

    public function testCanDeletePermission()
    {
        $permissionName = 'editPost';

        $this->rbac->createPermission($permissionName);

        $this->assertTrue($this->rbac->permissionExists($permissionName));

        $this->rbac->deletePermission($permissionName);

        $this->assertFalse($this->rbac->permissionExists($permissionName));
    }

    public function testCanAssignPermissionToRole()
    {
        $roleName = 'admin';
        $permissionName = 'editPost';

        // Создаем роль и разрешение
        $this->rbac->createRole($roleName);
        $this->rbac->createPermission($permissionName);

        $this->rbac->assignPermissionToRole($permissionName, $roleName);

        $this->assertTrue($this->rbac->isPermissionAssignedToRole($permissionName, $roleName));
    }

    public function testCanRevokePermissionFromRole()
    {
        $roleName = 'admin';
        $permissionName = 'editPost';

        $this->rbac->createRole($roleName);
        $this->rbac->createPermission($permissionName);
        $this->rbac->assignPermissionToRole($permissionName, $roleName);

        $this->rbac->revokePermissionFromRole($permissionName, $roleName);

        $this->assertFalse($this->rbac->isPermissionAssignedToRole($permissionName, $roleName));
    }

    public function testPermissionNotAssignedToRoleIfPermissionDoesNotExist()
    {
        $roleName = 'admin';
        $permissionName = 'editPost';

        // Создаем роль, но не создаем разрешение
        $this->rbac->createRole($roleName);

        // Проверяем, что разрешение не назначено роли
        $this->assertFalse($this->rbac->isPermissionAssignedToRole($permissionName, $roleName));
    }

    public function testPermissionNotAssignedToRoleIfRoleDoesNotExist()
    {
        $roleName = 'admin';
        $permissionName = 'editPost';

        $this->rbac->createPermission($permissionName);

        $this->assertFalse($this->rbac->isPermissionAssignedToRole($permissionName, $roleName));
    }

    public function testPermissionNotAssignedToRole()
    {
        $roleName = 'admin';
        $permissionName = 'editPost';

        $this->rbac->createRole($roleName);
        $this->rbac->createPermission($permissionName);

        $this->assertFalse($this->rbac->isPermissionAssignedToRole($permissionName, $roleName));
    }

    public function testCanCheckIfUserHasPermission()
    {
        $roleName = 'admin';
        $permissionName = 'editPost';
        $userName = 'John';

        $this->rbac->createRole($roleName);
        $this->rbac->createPermission($permissionName);
        $this->rbac->assignPermissionToRole($permissionName, $roleName);

        $this->rbac->addUserToRole($userName, $roleName);

        $this->assertTrue($this->rbac->userHasPermission($userName, $permissionName));
    }

    public function testUserDoesNotHavePermission()
    {
        $roleName = 'admin';
        $permissionName = 'editPost';
        $userName = 'John';

        $this->rbac->createRole($roleName);
        $this->rbac->createPermission($permissionName);

        $this->rbac->addUserToRole($userName, $roleName);

        $this->assertFalse($this->rbac->userHasPermission($userName, $permissionName));
    }

    public function testUserDoesNotExist()
    {
        $permissionName = 'editPost';
        $userName = 'John';

        $this->rbac->createPermission($permissionName);

        $this->assertFalse($this->rbac->userHasPermission($userName, $permissionName));
    }


}
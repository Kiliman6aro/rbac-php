<?php

namespace Repositories;

use HopHey\Rbac\Repositories\PermissionsRepository;
use PHPUnit\Framework\TestCase;

class PermissionTest extends TestCase
{
    protected PermissionsRepository $permission;

    protected function setUp(): void
    {
        $this->permission = new PermissionsRepository();
    }

    public function testInsert()
    {
        $this->assertFalse($this->permission->exists('editPost'));
        $this->permission->insert('editPost');
        $this->assertTrue($this->permission->exists('editPost'));
    }

    public function testDelete()
    {
        $this->permission->insert('editPost');
        $this->assertTrue($this->permission->exists('editPost'));
        $this->permission->delete('editPost');
        $this->assertFalse($this->permission->exists('editPost'));
    }
}
<?php

namespace Repository;

use HopHey\Rbac\Repositories\RolesRepository;
use PHPUnit\Framework\TestCase;

class RoleTest extends TestCase
{
    protected RolesRepository $role;

    protected function setUp(): void
    {
        $this->role = new RolesRepository();
    }

    public function testInsert()
    {
        $this->assertFalse($this->role->exists('admin'));
        $this->role->insert('admin');
        $this->assertTrue($this->role->exists('admin'));
    }

    public function testDelete()
    {
        $this->role->insert('admin');
        $this->assertTrue($this->role->exists('admin'));
        $this->role->delete('admin');
        $this->assertFalse($this->role->exists('admin'));
    }
}
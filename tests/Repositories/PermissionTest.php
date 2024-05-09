<?php

namespace Repositories;

use HopHey\Rbac\Repositories\PermissionsRepository;
use PHPUnit\Framework\TestCase;

class PermissionTest extends TestCase
{
    protected PermissionsRepository $permissionsRepository;

    protected function setUp(): void
    {
        $this->permissionsRepository = new PermissionsRepository();
    }

    public function testInsert()
    {
        $this->assertFalse($this->permissionsRepository->exists('editPost'));
        $this->permissionsRepository->insert('editPost');
        $this->assertTrue($this->permissionsRepository->exists('editPost'));
    }

    public function testDelete()
    {
        $this->permissionsRepository->insert('editPost');
        $this->assertTrue($this->permissionsRepository->exists('editPost'));
        $this->permissionsRepository->delete('editPost');
        $this->assertFalse($this->permissionsRepository->exists('editPost'));
    }
}
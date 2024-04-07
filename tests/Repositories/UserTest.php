<?php

namespace Repositories;

use HopHey\Rbac\Repositories\UsersRepository;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    protected $user;

    protected function setUp(): void
    {
        $this->user = new UsersRepository();
    }

    public function testInsert()
    {
        $this->assertFalse($this->user->exists('John'));
        $this->user->insert('John');
        $this->assertTrue($this->user->exists('John'));
    }

    public function testDelete()
    {
        $this->user->insert('John');
        $this->assertTrue($this->user->exists('John'));
        $this->user->delete('John');
        $this->assertFalse($this->user->exists('John'));
    }
}
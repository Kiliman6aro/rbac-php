<?php

namespace Repositories;

use HopHey\Rbac\Repositories\UsersRepository;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    protected $usersRepository;

    protected function setUp(): void
    {
        $this->usersRepository = new UsersRepository();
    }

    public function testInsert()
    {
        $this->assertFalse($this->usersRepository->exists('John'));
        $this->usersRepository->insert('John');
        $this->assertTrue($this->usersRepository->exists('John'));
    }

    public function testDelete()
    {
        $this->usersRepository->insert('John');
        $this->assertTrue($this->usersRepository->exists('John'));
        $this->usersRepository->delete('John');
        $this->assertFalse($this->usersRepository->exists('John'));
    }
}
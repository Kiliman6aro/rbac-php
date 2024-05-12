<?php

namespace HopHey\Rbac\Tests\Entities;

use HopHey\Rbac\Entities\StaticIntegerIdentity;
use PHPUnit\Framework\TestCase;

class StaticIntegerIdentityTest extends TestCase
{
    public function testToStringReturnsCorrectString()
    {
        $id = 123;
        $identity = new StaticIntegerIdentity($id);
        $this->assertIsString($identity->toString());
    }

    public function testGenerateCreatesInstanceOfStaticIdentity()
    {
        $id = 456;
        $identity = StaticIntegerIdentity::generate($id);
        $this->assertInstanceOf(StaticIntegerIdentity::class, $identity);
        $this->assertEquals($id, $identity->toString());
    }
}
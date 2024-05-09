<?php
use HopHey\Rbac\Entities\UUIDIdentity;
use PHPUnit\Framework\TestCase;

class UUIDIdentityTest extends TestCase
{
    public function testToStringReturnsCorrectString()
    {
        $identity = UUIDIdentity::generate();
        $this->assertIsString($identity->toString());
    }
}
<?php

namespace Tests\Model\Component;

use DamianJozwiak\CodeGenerator\Model\Component\ConstructorParamComponent;
use PHPUnit\Framework\TestCase;

class ConstructorParamTest extends TestCase
{
    public function testAccess()
    {
        $arg = new ConstructorParamComponent('test', 'int', 5, useDefault: true, access: 'private');
        $this->assertEquals(['private readonly int $test = 5'], $arg->toLines());
    }

    public function testReadonly()
    {
        $arg = new ConstructorParamComponent('test', 'string', 'aaa', useDefault: true, readonly: false);
        $this->assertEquals(['protected string $test = \'aaa\''], $arg->toLines());
    }
}

<?php

namespace Tests\Model\Component;

use DamianJozwiak\CodeGenerator\Model\Component\ArgumentComponent;
use PHPUnit\Framework\TestCase;

class ArgumentComponentTest extends TestCase
{
    public function testNumbers()
    {
        $arg = new ArgumentComponent('test', 'int', 5, useDefault: true);
        $this->assertEquals(['int $test = 5'], $arg->toLines());

        $arg = new ArgumentComponent('test', 'float', 5.5, useDefault: true);
        $this->assertEquals(['float $test = 5.5'], $arg->toLines());
    }

    public function testString()
    {
        $arg = new ArgumentComponent('test', 'string', 'aaa', useDefault: true);
        $this->assertEquals(['string $test = \'aaa\''], $arg->toLines());
    }

    public function testNull()
    {
        $arg = new ArgumentComponent('test', '?string', null, useDefault: true);
        $this->assertEquals(['?string $test = null'], $arg->toLines());
    }

    public function testBooleans()
    {
        $arg = new ArgumentComponent('test', 'bool', false, useDefault: true);
        $this->assertEquals(['bool $test = false'], $arg->toLines());

        $arg = new ArgumentComponent('test', 'bool', true, useDefault: true);
        $this->assertEquals(['bool $test = true'], $arg->toLines());
    }

    public function testArrays()
    {
        $arg = new ArgumentComponent('test', 'array', [1, 2, 3], useDefault: true);
        $this->assertEquals(['array $test = [1, 2, 3]'], $arg->toLines());

        $arg = new ArgumentComponent('test', 'array', ['a' => 1, 'b' => 2], useDefault: true);
        $this->assertEquals(['array $test = [\'a\' => 1, \'b\' => 2]'], $arg->toLines());
    }

    public function testWithoutDefault()
    {
        $arg = new ArgumentComponent('test', 'float', 5.5, useDefault: false);
        $this->assertEquals(['float $test'], $arg->toLines());
    }

    public function testWithoutType()
    {
        $arg = new ArgumentComponent('test', null, 5.5, useDefault: false);
        $this->assertEquals(['$test'], $arg->toLines());
        $arg = new ArgumentComponent('test', null, 25, useDefault: true);
        $this->assertEquals(['$test = 25'], $arg->toLines());
    }

}
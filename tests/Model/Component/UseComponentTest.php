<?php

namespace Tests\Model\Component;

use DamianJozwiak\CodeGenerator\Model\Component\UseComponent;
use PHPUnit\Framework\TestCase;

class UseComponentTest extends TestCase
{
    public function testUse()
    {
        $u = new UseComponent('test');
        $this->assertEquals(['use test;'], $u->toLines());
    }
}
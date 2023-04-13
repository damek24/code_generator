<?php

namespace Tests\Model\Component;

use DamianJozwiak\CodeGenerator\Enums\AccessEnum;
use DamianJozwiak\CodeGenerator\Model\Component\VirtualMethodComponent;
use PHPUnit\Framework\TestCase;

class VirtualMethodComponentTest extends TestCase
{
    public function testVirtual()
    {
        $v = new VirtualMethodComponent('test', AccessEnum::PUBLIC);
        $this->assertEquals(['@method public test();'], $v->toLines());
        $v = new VirtualMethodComponent('test', AccessEnum::PUBLIC, abstract: true);
        $this->assertEquals(['@method abstract public test();'], $v->toLines());
    }
}

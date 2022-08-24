<?php

namespace Tests\Model\Component;

use DamianJozwiak\CodeGenerator\Model\Component\NamespaceComponent;
use PHPUnit\Framework\TestCase;

class NamespaceComponentTest extends TestCase
{
    public function testNamespace()
    {
        $n = new NamespaceComponent('foo');
        $lines = ['namespace foo;'];
        $this->assertEquals($lines, $n->toLines());
    }
}
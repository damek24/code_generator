<?php

namespace Tests\Model\Component;

use DamianJozwiak\CodeGenerator\Enums\AccessEnum;
use DamianJozwiak\CodeGenerator\Model\Component\DocBlockComponent;
use DamianJozwiak\CodeGenerator\Model\Component\PropertyComponent;
use PHPUnit\Framework\TestCase;

class PropertyComponentTest extends TestCase
{
    public function testNormalProperty()
    {
        $p = new PropertyComponent('test', AccessEnum::PUBLIC);
        $this->assertEquals('public $test;', $p->generateProperty());
    }

    public function testTypedProperty()
    {
        $p = new PropertyComponent('test', AccessEnum::PUBLIC, type: 'int');
        $this->assertEquals('public int $test;', $p->generateProperty());
    }

    public function testStaticProperty()
    {
        $p = new PropertyComponent('test', AccessEnum::PUBLIC, static: true);
        $this->assertEquals('public static $test;', $p->generateProperty());
    }

    public function testPropertyWithValue()
    {
        $p = new PropertyComponent('test', AccessEnum::PUBLIC, value: 10, useDefault: true);
        $this->assertEquals('public $test = 10;', $p->generateProperty());
    }

    public function testMethodDocBlock()
    {
        $doc = new DocBlockComponent();
        $p = new PropertyComponent('test', AccessEnum::PUBLIC, docBlock: $doc, value: 10, useDefault: true);
        $lines = ['/**', ' *', ' */', 'public $test = 10;', ''];
        $this->assertEquals($lines, $p->toLines());
    }
}
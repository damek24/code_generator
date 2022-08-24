<?php

namespace Tests\Model\Component;

use DamianJozwiak\CodeGenerator\Model\Component\ClassNameComponent;
use PHPUnit\Framework\TestCase;

class ClassNameComponentTest extends TestCase
{
    public function testStandardClass()
    {
        $name = new ClassNameComponent('test');
        $this->assertEquals('class test', $name->toLines()[0]);
    }

    public function testAbstractClass()
    {
        $name = new ClassNameComponent('test', abstract: true);
        $this->assertEquals('abstract class test', $name->toLines()[0]);
    }

    public function testFinalClass()
    {
        $name = new ClassNameComponent('test', final: true);
        $this->assertEquals('final class test', $name->toLines()[0]);
    }

    public function testFinalAbstractClass()
    {
        $name = new ClassNameComponent('test', abstract: true, final: true);
        $this->expectException(\InvalidArgumentException::class);
        $name->render();
        //$this->assertEquals('final class test', $name->toLines()[0]);
    }

    public function testClassExtends()
    {
        $name = new ClassNameComponent('test', extends: 'foo');
        $this->assertEquals('class test extends foo', $name->toLines()[0]);
    }

    public function testClassImplements()
    {
        $name = new ClassNameComponent('test', implements: 'foo');
        $this->assertEquals('class test implements foo', $name->toLines()[0]);
        $name = new ClassNameComponent('test', implements: ['foo', 'bar']);
        $this->assertEquals('class test implements foo, bar', $name->toLines()[0]);
    }
}
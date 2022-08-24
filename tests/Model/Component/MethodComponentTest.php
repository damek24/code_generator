<?php

namespace Tests\Model\Component;

use DamianJozwiak\CodeGenerator\Enums\AccessEnum;
use DamianJozwiak\CodeGenerator\Model\Component\ArgumentComponent;
use DamianJozwiak\CodeGenerator\Model\Component\DocBlockComponent;
use DamianJozwiak\CodeGenerator\Model\Component\MethodComponent;
use PHPUnit\Framework\TestCase;

class MethodComponentTest extends TestCase
{
    public function testAddArguments()
    {
        $method = new MethodComponent('test', AccessEnum::UNDEFINED);
        $method->addArgument(new ArgumentComponent(name: 'test', type: 'int', default: 5, useDefault: true));
        $method->addArgument(new ArgumentComponent(name: 'test2', type: 'int', default: 25, useDefault: true));
        $expected = 'function test(int $test = 5, int $test2 = 25)';
        $this->assertEquals($expected, $method->generateFunctionName());
    }

    public function testFinalFunction()
    {
        $method = new MethodComponent('test', AccessEnum::UNDEFINED, final: true);
        $expected = 'final function test()';
        $this->assertEquals($expected, $method->generateFunctionName());
    }

    public function testAbstractFunction()
    {
        $method = new MethodComponent('test', AccessEnum::UNDEFINED, abstract: true);
        $expected = 'abstract function test();';
        $this->assertEquals($expected, $method->generateFunctionName());
    }

    public function testStaticFunction()
    {
        $method = new MethodComponent('test', AccessEnum::UNDEFINED, static: true);
        $expected = 'static function test()';
        $this->assertEquals($expected, $method->generateFunctionName());
    }

    public function typeProvider(): array
    {
        return [
            AccessEnum::PRIVATE => [AccessEnum::PRIVATE],
            AccessEnum::PUBLIC => [AccessEnum::PUBLIC],
            AccessEnum::PROTECTED => [AccessEnum::PROTECTED],
        ];
    }

    /**
     * @dataProvider typeProvider
     */
    public function testMethodAccess(string $access)
    {
        $method = new MethodComponent('test', access: $access);
        $expected = $access . ' function test()';
        $this->assertEquals($expected, $method->generateFunctionName());
    }

    public function testAbstractAndFinal()
    {
        $method = new MethodComponent('test', AccessEnum::UNDEFINED, abstract: true, final: true);
        $this->expectException(\InvalidArgumentException::class);
        $method->render();
    }

    public function testMethodDocBlock()
    {
        $doc = new DocBlockComponent();
        $method = new MethodComponent('test', AccessEnum::PUBLIC, docBlock: $doc);
        $lines = ['/**', ' *', ' */', 'public function test()', '{', '}', ''];
        $this->assertEquals($lines, $method->toLines());
    }
}
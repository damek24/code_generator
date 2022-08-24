<?php

namespace Tests\Model\Component;

use DamianJozwiak\CodeGenerator\Model\Component\DocBlockComponent;
use PHPUnit\Framework\TestCase;

class DocBlockComponentTest extends TestCase
{
    public function testEmpty()
    {
        $docBlock = new DocBlockComponent();
        $lines = ['/**', ' *', ' */'];
        $this->assertEquals($lines, $docBlock->toLines());
    }

    public function testComment()
    {
        $docBlock = new DocBlockComponent('@return test');
        $lines = ['/**', ' * @return test', ' */'];
        $this->assertEquals($lines, $docBlock->toLines());
    }

    public function testMultipleComments()
    {
        $docBlock = new DocBlockComponent(['foo', 'bar']);
        $lines = ['/**', ' * foo', ' * bar', ' */'];
        $this->assertEquals($lines, $docBlock->toLines());
    }
}
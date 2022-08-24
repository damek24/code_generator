<?php

namespace Tests\Model\Component;

use DamianJozwiak\CodeGenerator\Enums\AccessEnum;
use DamianJozwiak\CodeGenerator\Model\Component\ConstantComponent;
use PHPUnit\Framework\TestCase;

class ConstantComponentTest extends TestCase
{
    public function testConstant()
    {
        $constant = new ConstantComponent('test', 5);
        $this->assertEquals('const TEST = 5;', $constant->toLines()[0]);
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
     * @return void
     */
    public function testTypedConstant(string $access)
    {
        $constant = new ConstantComponent('test', 5, access: $access);
        $this->assertEquals($access . ' const TEST = 5;', $constant->toLines()[0]);
    }

}
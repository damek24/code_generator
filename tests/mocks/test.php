<?php

namespace Test\Files;

use Test\A;
/**
 * class summary
 * @property int $propertyFour
 * @method static void methodFour();
 */
class Foo extends Bar implements A, B
{
    use TraitOne;

    public const PROPERTYONE = 5;
    

    protected $propertyTwo;
    
    private int $propertyThree = 5;
    

    protected static function methodOne()
    {
    }
    
    /**
     * method
     * multiline
     * description
     */
    private function methodTwo(int $argumentOne = 5): array
    {
    return [];
    }
    
}

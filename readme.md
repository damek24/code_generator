# Code generator

## Installation

Require the package using composer
`composer require damian_jozwiak/code_generator --dev`.
PHP 8 required

## Usage

```php
use DamianJozwiak\CodeGenerator\Enums\AccessEnum;
use DamianJozwiak\CodeGenerator\Model\Component\ArgumentComponent;
use DamianJozwiak\CodeGenerator\Model\Component\ClassNameComponent;
use DamianJozwiak\CodeGenerator\Model\Component\ConstantComponent;
use DamianJozwiak\CodeGenerator\Model\Component\DocBlockComponent;
use DamianJozwiak\CodeGenerator\Model\Component\MethodComponent;
use DamianJozwiak\CodeGenerator\Model\Component\NamespaceComponent;
use DamianJozwiak\CodeGenerator\Model\Component\PropertyComponent;
use DamianJozwiak\CodeGenerator\Model\Component\UseComponent;
use DamianJozwiak\CodeGenerator\Model\Component\VirtualMethodComponent;
use DamianJozwiak\CodeGenerator\Model\Component\VirtualPropertyComponent;
use DamianJozwiak\CodeGenerator\Model\Generators\ClassGenerator;

$vp = new VirtualPropertyComponent('propertyFour', AccessEnum::PUBLIC, type: 'int');
$vm = new VirtualMethodComponent('methodFour', AccessEnum::UNDEFINED, static: true, returnType: 'void');
$generator = new ClassGenerator(
     name: new ClassNameComponent('Foo', extends: 'Bar', implements: ['A', 'B']),
     namespace: new NamespaceComponent('Test\\Files'),
     doc: new DocBlockComponent([
         'class summary',
          $vp->render(indent: 0),
          $vm->render(indent: 0),
          ])
     );
$generator->addUseClass(new UseComponent('Test\\A'));
$generator->addUseTrait(new UseComponent('TraitOne'));
$generator->addConstant(new ConstantComponent('propertyOne', 5, AccessEnum::PUBLIC));
$generator->addProperty(new PropertyComponent('propertyTwo', AccessEnum::PROTECTED));
$generator->addProperty(
    new PropertyComponent(
        'propertyThree',
        access: AccessEnum::PRIVATE,
        type: 'int',
        value: 5,
        useDefault: true
    )
);
$doc = new DocBlockComponent(['method', 'multiline', 'description']);
$generator->addMethod(new MethodComponent('methodOne', AccessEnum::PROTECTED, static: true));
$method = new MethodComponent('methodTwo', AccessEnum::PRIVATE, returnType: 'array', docBlock: $doc);
$method->addArgument(new ArgumentComponent('argumentOne', type: 'int', default: 5, useDefault: true));
$method->setBody(['return [];']);
$generator->addMethod($method);
$s = DIRECTORY_SEPARATOR;
$path = dirname(__DIR__, 2) . $s . 'mocks' . $s . 'test.php';
$content = file_get_contents($path);
file_put_contents('test.php', $generator->render(0));
$this->assertEquals($content, $generator->render(0));

```

Output

```php
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


```
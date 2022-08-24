<?php

namespace DamianJozwiak\CodeGenerator\Model\Generators;

use DamianJozwiak\CodeGenerator\Model\Component\ClassNameComponent;
use DamianJozwiak\CodeGenerator\Model\Component\ConstantComponent;
use DamianJozwiak\CodeGenerator\Model\Component\DocBlockComponent;
use DamianJozwiak\CodeGenerator\Model\Component\MethodComponent;
use DamianJozwiak\CodeGenerator\Model\Component\NamespaceComponent;
use DamianJozwiak\CodeGenerator\Model\Component\PropertyComponent;
use DamianJozwiak\CodeGenerator\Model\Component\UseComponent;
use DamianJozwiak\CodeGenerator\Renderable;

class ClassGenerator extends Renderable
{
    public function __construct(
        protected ClassNameComponent $name,
        protected NamespaceComponent $namespace,
        protected ?DocBlockComponent $doc = null
    ) {
    }

    protected array $useClasses = [];

    public function addUseClass(UseComponent $useComponent)
    {
        $this->useClasses[] = $useComponent;
    }

    protected array $useTraits = [];

    public function addUseTrait(UseComponent $useComponent)
    {
        $this->useTraits[] = $useComponent;
    }

    protected array $properties = [];

    public function addProperty(PropertyComponent $property)
    {
        $this->properties[] = $property;
    }

    protected array $constants = [];

    public function addConstant(ConstantComponent $constant)
    {
        $this->constants[] = $constant;
    }

    protected array $methods = [];

    public function addMethod(MethodComponent $method)
    {
        $this->methods[] = $method;
    }

    public function toLines(): array
    {
        $lines = [
            $this->line('<?php'),
            $this->namespace->render(0),
            ''
        ];
        if (!empty($this->useClasses)) {
            $lines = [...$lines, ...$this->processArray($this->useClasses, indent: 0)];
        }
        if ($this->doc) {
            $lines = [...$lines, ...$this->doc->toLines()];
        }
        $lines [] = $this->name->render(0);
        if (!empty($this->useTraits)) {
            $lines = [...$lines, ...$this->processArray($this->useTraits)];
        }
        if (!empty($this->constants)) {
            $lines = [...$lines, '', ...$this->processArray($this->constants)];
        }
        if (!empty($this->properties)) {
            $lines = [...$lines, '', ...$this->processArray($this->properties)];
        }
        if (!empty($this->methods)) {
            $lines = [...$lines, '', ...$this->processArray($this->methods)];
        }
        $lines[] = '}';
        $lines[] = '';
        return $lines;
    }
}
<?php

namespace DamianJozwiak\CodeGenerator\Model\Component;

use DamianJozwiak\CodeGenerator\Renderable;
use DamianJozwiak\CodeGenerator\Traits\ValueTrait;

abstract class BasePropertyComponent extends Renderable
{
    use ValueTrait;

    public function __construct(
        protected string $name,
        protected string $access,
        protected string $type = '',
        protected bool $static = false,
        protected ?DocBlockComponent $docBlock = null,
        protected mixed $value = null,
        protected bool $useDefault = false
    ) {
    }

    public function generateProperty(): string
    {
        $property = $this->access . ' ';
        if ($this->static) {
            $property .= 'static ';
        }
        if ($this->type) {
            $property .= $this->type . ' ';
        }
        $property .= '$' . $this->name;
        if ($this->useDefault) {
            $property .= ' = ' . $this->renderTyped($this->value);
        }
        return $property . ';';
    }
}
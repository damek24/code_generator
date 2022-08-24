<?php

namespace DamianJozwiak\CodeGenerator\Model\Component;

use DamianJozwiak\CodeGenerator\Renderable;
use DamianJozwiak\CodeGenerator\Traits\ValueTrait;

class ArgumentComponent extends Renderable
{
    use ValueTrait;

    public function __construct(
        protected string $name,
        protected ?string $type = null,
        protected mixed $default = null,
        protected bool $useDefault = false
    ) {
    }

    public function toLines(): array
    {
        $value = is_null($this->type) ? '$' . $this->name : $this->type . ' $' . $this->name;

        if ($this->useDefault) {
            $value .= ' = ' . $this->renderTyped($this->default);
        }
        return [$value];
    }
}
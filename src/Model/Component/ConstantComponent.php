<?php

namespace DamianJozwiak\CodeGenerator\Model\Component;

use DamianJozwiak\CodeGenerator\Enums\AccessEnum;
use DamianJozwiak\CodeGenerator\Renderable;
use DamianJozwiak\CodeGenerator\Traits\ValueTrait;

class ConstantComponent extends Renderable
{
    use ValueTrait;

    public function __construct(
        protected string $name,
        protected mixed $value,
        protected string $access = AccessEnum::UNDEFINED
    ) {
        $this->name = mb_strtoupper($this->name);
    }

    public function toLines(): array
    {
        $value = $this->renderTyped($this->value);
        $name = $this->access;
        if ($this->access !== AccessEnum::UNDEFINED) {
            $name .= ' ';
        }
        return [$name . sprintf('const %s = %s;', $this->name, $value), ''];
    }
}
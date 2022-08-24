<?php

namespace DamianJozwiak\CodeGenerator\Model\Component;

use DamianJozwiak\CodeGenerator\Renderable;

class UseComponent extends Renderable
{
    public function __construct(protected string $name)
    {
    }

    public function toLines(): array
    {
        return [sprintf('use %s;', $this->name)];
    }
}
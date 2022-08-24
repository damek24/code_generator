<?php

namespace DamianJozwiak\CodeGenerator\Model\Component;

use DamianJozwiak\CodeGenerator\Renderable;

class NamespaceComponent extends Renderable
{
    public function __construct(protected string $namespace)
    {
    }

    public function toLines(): array
    {
        return [sprintf('namespace %s;', $this->namespace)];
    }
}
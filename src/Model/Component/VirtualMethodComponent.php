<?php

namespace DamianJozwiak\CodeGenerator\Model\Component;

class VirtualMethodComponent extends BaseMethodComponent
{

    public function toLines(): array
    {
        $f = $this->generateFunctionName(addFunction: false);
        return ['@method ' . rtrim($f, ';') . ';'];
    }
}
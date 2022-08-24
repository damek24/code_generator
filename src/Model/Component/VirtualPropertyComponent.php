<?php

namespace DamianJozwiak\CodeGenerator\Model\Component;

class VirtualPropertyComponent extends BasePropertyComponent
{

    public function toLines(): array
    {
        $property = '@property';
        if ($this->type !== null) {
            $property .= ' ' . $this->type;
        }
        return [$property . ' $' . $this->name];
    }
}
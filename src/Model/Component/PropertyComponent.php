<?php

namespace DamianJozwiak\CodeGenerator\Model\Component;

class PropertyComponent extends BasePropertyComponent
{


    public function toLines(): array
    {
        $lines = [];
        if ($this->docBlock) {
            $lines = $this->docBlock->toLines();
        }
        $lines[] = $this->generateProperty();
        $lines[] = '';
        return $lines;
    }
}
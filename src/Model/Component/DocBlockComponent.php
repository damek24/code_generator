<?php

namespace DamianJozwiak\CodeGenerator\Model\Component;

use DamianJozwiak\CodeGenerator\Renderable;

class DocBlockComponent extends Renderable
{
    public function __construct(protected array|string $content = [])
    {
        if (is_string($this->content)) {
            $this->content = [$this->content];
        }
    }

    public function toLines(): array
    {
        $lines = [];
        $lines[] = '/**';
        if (!empty($this->content)) {
            foreach ($this->content as $item) {
                $lines[] = sprintf(' * %s', $item);
            }
        } else {
            $lines[] = ' *';
        }
        $lines[] = ' */';

        return $lines;
    }
}
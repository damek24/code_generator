<?php

namespace DamianJozwiak\CodeGenerator\Model\Component;

use DamianJozwiak\CodeGenerator\Renderable;
use InvalidArgumentException;

class ClassNameComponent extends Renderable
{
    public function __construct(
        protected string $name,
        protected string $extends = '',
        protected array|string $implements = [],
        protected bool $abstract = false,
        protected bool $final = false,
    ) {
        if (is_string($this->implements)) {
            $this->implements = [$this->implements];
        }
    }

    public function toLines(): array
    {
        $name = '';
        if ($this->final) {
            $name .= 'final ';
        }
        if ($this->abstract) {
            $name .= 'abstract ';
        }
        $name .= 'class ' . $this->name;
        if ($this->extends) {
            $name .= sprintf(' extends %s', $this->extends);
        }
        if (count($this->implements) > 0) {
            $name .= sprintf(' implements %s', implode(', ', $this->implements));
        }
        $lines = [$name];
        $lines[] = '{';
        return $lines;
    }

    protected function validate(): bool
    {
        if ($this->final && $this->abstract) {
            throw new InvalidArgumentException('Entity cannot be final and abstract at the same time');
        }

        return parent::validate();
    }
}
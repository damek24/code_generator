<?php

namespace DamianJozwiak\CodeGenerator\Model\Component;

class MethodComponent extends BaseMethodComponent
{


    public function toLines(): array
    {
        $lines = [];
        if ($this->docBlock) {
            $lines = $this->docBlock->toLines();
        }
        $lines[] = $this->generateFunctionName();
        if (!$this->abstract) {
            $lines [] = '{';
        }
        if (!empty($this->body)) {
            $lines = [...$lines, ...$this->body];
        }
        $lines[] = '}';
        $lines[] = '';
        return $lines;
    }

    protected array $body = [];

    public function setBody(array $lines)
    {
        $this->body = $lines;
    }

    protected function validate(): bool
    {
        if ($this->abstract and ($this->final or $this->static)) {
            throw new \InvalidArgumentException('Entity cannot be abstract and final or static at the same time');
        }

        return parent::validate();
    }
}
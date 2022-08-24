<?php

namespace DamianJozwiak\CodeGenerator\Traits;

trait ValueTrait
{
    protected function renderValueArray(array $value): string
    {
        $parts = [];
        foreach ($value as $key => $item) {
            if (is_numeric($key)) {
                $parts[] = $this->renderTyped($item);
            } else {
                $parts[] = sprintf('\'%s\'', addslashes($key)) . ' => ' . $this->renderTyped($item);
            }
        }
        return '[' . implode(', ', $parts) . ']';
    }

    protected function renderTyped(mixed $value): string
    {
        $type = gettype($value);
        return match ($type) {
            'boolean' => $value ? 'true' : 'false',
            'integer', 'double' => $value,
            'string' => sprintf('\'%s\'', addslashes($value)),
            'array' => $this->renderValueArray($value),
            default => 'null'
        };
    }
}
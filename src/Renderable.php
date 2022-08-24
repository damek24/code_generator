<?php

namespace DamianJozwiak\CodeGenerator;

use DamianJozwiak\CodeGenerator\Contract\Lineable;
use DamianJozwiak\CodeGenerator\Contract\Renderable as RendererContract;

abstract class Renderable implements Lineable, RendererContract
{
    final public function render(int $indent = 4, string $delimiter = PHP_EOL): string
    {
        $this->validate();
        $lines = $this->toLines();
        if ($indent > 0) {
            array_walk($lines, function (&$item) use ($indent) {
                $item = str_repeat(' ', $indent) . $item;
            });
        }
        return implode($delimiter, $lines);
    }

    protected function processArray(array $array, int $indent = 4, string $delimiter = PHP_EOL): array
    {
        $items = array_filter($array, fn(mixed $item) => $item instanceof RendererContract);
        return array_map(fn(RendererContract $item) => $item->render($indent, $delimiter), $items);
    }

    protected function validate(): bool
    {
        return true;
    }

    protected function line(string $line): string
    {
        return $line . PHP_EOL;
    }
}
<?php

namespace DamianJozwiak\CodeGenerator\Contract;

interface Renderable
{
    public function render(int $indent = 0, string $delimiter = PHP_EOL): string;
}
<?php

namespace DamianJozwiak\CodeGenerator\Contract;

interface Lineable
{
    /**
     * @return string[]
     */
    public function toLines(): array;
}
<?php

namespace DamianJozwiak\CodeGenerator\Model\Component;

use DamianJozwiak\CodeGenerator\Enums\AccessEnum;
use DamianJozwiak\CodeGenerator\Renderable;

abstract class BaseMethodComponent extends Renderable
{
    public function __construct(
        protected string $name,
        protected string $access,
        protected bool $abstract = false,
        protected bool $static = false,
        protected bool $final = false,
        protected string $returnType = '',
        protected ?DocBlockComponent $docBlock = null
    ) {
    }

    protected array $arguments = [];

    public function addArgument(ArgumentComponent $argument)
    {
        $this->arguments[] = $argument;
    }

    protected function renderArguments(): string
    {
        $args = $this->arguments;
        $args = array_map(fn(ArgumentComponent $arg) => $arg->render(indent: 0), $args);
        return implode(', ', $args);
    }

    public function generateFunctionName(bool $addFunction = true): string
    {
        $function = '';
        if ($this->final) {
            $function .= 'final ';
        }
        if ($this->abstract) {
            $function .= 'abstract ';
        }
        if ($this->access !== AccessEnum::UNDEFINED) {
            $function .= $this->access . ' ';
        }

        if ($this->static) {
            $function .= 'static ';
        }

        if ($addFunction) {
            $function .= 'function ';
        } elseif ($this->returnType) {
            $function .= $this->returnType . ' ';
        }

        $function .= $this->name . '(' . $this->renderArguments() . ')';

        if ($this->returnType && $addFunction) {
            $function .= ': ' . $this->returnType;
        }

        if ($this->abstract) {
            $function .= ';';
        }
        return $function;
    }

}
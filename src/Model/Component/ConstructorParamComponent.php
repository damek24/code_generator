<?php

namespace DamianJozwiak\CodeGenerator\Model\Component;

class ConstructorParamComponent extends ArgumentComponent
{
    public function __construct(
        string $name,
        ?string $type = null,
        mixed $default = null,
        bool $useDefault = false,
        protected ?string $access = 'protected',
        protected bool $readonly = true,
    ) {
        parent::__construct($name, $type, $default, $useDefault);
    }

    public function toLines(): array
    {
        $value = $this->access ?? '';
        if ($this->readonly) {
            $value .= ' readonly';
        }
        $type = is_null($this->type) ? '$' . $this->name : $this->type . ' $' . $this->name;
        $value .= ' ' . $type;

        if ($this->useDefault) {
            $value .= ' = ' . $this->renderTyped($this->default);
        }
        return [$value];
    }
}

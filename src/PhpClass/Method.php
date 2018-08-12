<?php

namespace PhpCodeMaker\PhpClass;

/**
 *
 */
class Method extends \PhpCodeMaker\PhpFunction
{
    use VisiblityTrait;

    public function render(): string
    {
        $function =  str_replace(
            "function {$this->name}",
            "    {$this->visiblity} function {$this->name}",
            parent::render()
        );

        $function = str_replace("\n", "\n    ", $function);

        return $function;
    }
}

<?php

namespace PhpCodeMaker\PhpClass;

/**
 *
 */
class Method extends \PhpCodeMaker\PhpFunction
{
    use VisiblityTrait;

    public function render()
    {
        $function = parent::render();

        return str_replace("function {$this->name}", "{$this->visiblity} function {$this->name}", $function);
    }
}

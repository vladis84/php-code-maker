<?php

namespace ClassGen\PhpClass;

/**
 *
 */
class Method extends \ClassGen\PhpFunction
{
    use VisiblityTrait;

    public function render()
    {
        $function = parent::render();

        return str_replace("function {$this->name}", "{$this->visiblity} function {$this->name}", $function);
    }
}

<?php

namespace PhpCodeMaker\PhpClass;

/**
 *
 */
class Property extends \PhpCodeMaker\Element
{
    use VisiblityTrait;

    public function render()
    {
        return <<<PHP
    /**
     * {$this->description}
    */
    {$this->visiblity} \${$this->name};\n
PHP;
    }
}

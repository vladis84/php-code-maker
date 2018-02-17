<?php

namespace ClassGen\PhpClass;

/**
 *
 */
class Property extends \ClassGen\Element
{
    use VisiblityTrait;

    public function render()
    {
        return <<<PHP
/**
 * {$this->description}
*/
{$this->visiblity} \${$this->name};
PHP;
    }
}

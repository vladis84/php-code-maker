<?php

namespace ClassGen\PhpFunction;

/**
 *
 */
class Param extends \ClassGen\Element
{
    /**
     *
     * @var string
     */
    protected $type;

    public function render()
    {
        return "{$this->type} \${$this->name}";
    }
}

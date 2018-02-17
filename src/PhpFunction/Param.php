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
    public $type;

    public function setType($type)
    {
        $this->type = $type;
        
        return $this;
    }

    public function render()
    {
        return "{$this->type} \${$this->name}";
    }
}

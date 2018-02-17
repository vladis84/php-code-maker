<?php

namespace PhpCodeMaker\PhpFunction;

/**
 *
 */
class Param extends \PhpCodeMaker\Element
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

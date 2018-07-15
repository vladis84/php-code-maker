<?php

namespace PhpCodeMaker;

class PhpDoc extends Element
{
    /**
     * @return string
     */
    public function render(): string
    {
        return " * {$this->name} {$this->description}\n";
    }
}
